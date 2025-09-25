// Service Worker for Zohoor Al Shafa PWA
// Version 1.0.0

const CACHE_NAME = 'zohoor-menu-v1.0.0';
const STATIC_CACHE = 'zohoor-static-v1.0.0';
const DYNAMIC_CACHE = 'zohoor-dynamic-v1.0.0';

// Files to cache immediately (static assets)
const STATIC_FILES = [
  '/',
  '/css/style.css',
  '/js/menu.js',
  '/images/logo.png',
  '/images/zz.png',
  '/images/1.pdf.png',
  '/images/2.pdf.png',
  '/images/3.pdf.png',
  '/images/4.pdf.png',
  '/images/5.pdf.png',
  '/images/6.pdf.png',
  '/manifest.webmanifest'
];

// API endpoints to cache
const API_ENDPOINTS = [
  '/api/menu'
];

// Install event - cache static files
self.addEventListener('install', (event) => {
  console.log('Service Worker: Installing...');
  
  event.waitUntil(
    caches.open(STATIC_CACHE)
      .then((cache) => {
        console.log('Service Worker: Caching static files');
        return cache.addAll(STATIC_FILES);
      })
      .then(() => {
        console.log('Service Worker: Static files cached successfully');
        return self.skipWaiting();
      })
      .catch((error) => {
        console.error('Service Worker: Failed to cache static files', error);
      })
  );
});

// Activate event - clean up old caches
self.addEventListener('activate', (event) => {
  console.log('Service Worker: Activating...');
  
  event.waitUntil(
    caches.keys()
      .then((cacheNames) => {
        return Promise.all(
          cacheNames.map((cacheName) => {
            if (cacheName !== STATIC_CACHE && cacheName !== DYNAMIC_CACHE) {
              console.log('Service Worker: Deleting old cache', cacheName);
              return caches.delete(cacheName);
            }
          })
        );
      })
      .then(() => {
        console.log('Service Worker: Activated successfully');
        return self.clients.claim();
      })
  );
});

// Fetch event - serve from cache, fallback to network
self.addEventListener('fetch', (event) => {
  const { request } = event;
  const url = new URL(request.url);
  
  // Skip non-GET requests
  if (request.method !== 'GET') {
    return;
  }
  
  // Skip external requests
  if (url.origin !== location.origin) {
    return;
  }
  
  event.respondWith(
    handleRequest(request)
  );
});

// Handle different types of requests
async function handleRequest(request) {
  const url = new URL(request.url);
  
  try {
    // API requests - cache with network first strategy
    if (url.pathname.startsWith('/api/')) {
      return await handleApiRequest(request);
    }
    
    // Static files - cache first strategy
    if (isStaticFile(url.pathname)) {
      return await handleStaticRequest(request);
    }
    
    // HTML pages - network first, fallback to cache
    return await handlePageRequest(request);
    
  } catch (error) {
    console.error('Service Worker: Error handling request', error);
    return await handleOfflineFallback(request);
  }
}

// Handle API requests (menu data)
async function handleApiRequest(request) {
  try {
    // Try network first
    const networkResponse = await fetch(request);
    
    if (networkResponse.ok) {
      // Cache the response
      const cache = await caches.open(DYNAMIC_CACHE);
      cache.put(request, networkResponse.clone());
      return networkResponse;
    }
    
    throw new Error('Network response not ok');
    
  } catch (error) {
    console.log('Service Worker: Network failed, trying cache for API');
    
    // Fallback to cache
    const cachedResponse = await caches.match(request);
    if (cachedResponse) {
      return cachedResponse;
    }
    
    // Return offline fallback for API
    return new Response(
      JSON.stringify({
        categories: [],
        products: [],
        favorites: [],
        offline: true,
        message: 'You are offline. Showing cached data.'
      }),
      {
        headers: { 'Content-Type': 'application/json' }
      }
    );
  }
}

// Handle static files (CSS, JS, images)
async function handleStaticRequest(request) {
  // Try cache first
  const cachedResponse = await caches.match(request);
  if (cachedResponse) {
    return cachedResponse;
  }
  
  try {
    // Try network
    const networkResponse = await fetch(request);
    if (networkResponse.ok) {
      // Cache the response
      const cache = await caches.open(STATIC_CACHE);
      cache.put(request, networkResponse.clone());
      return networkResponse;
    }
    
    throw new Error('Network response not ok');
    
  } catch (error) {
    console.log('Service Worker: Network failed for static file');
    return await handleOfflineFallback(request);
  }
}

// Handle HTML pages
async function handlePageRequest(request) {
  try {
    // Try network first
    const networkResponse = await fetch(request);
    
    if (networkResponse.ok) {
      // Cache the response
      const cache = await caches.open(DYNAMIC_CACHE);
      cache.put(request, networkResponse.clone());
      return networkResponse;
    }
    
    throw new Error('Network response not ok');
    
  } catch (error) {
    console.log('Service Worker: Network failed, trying cache for page');
    
    // Fallback to cache
    const cachedResponse = await caches.match(request);
    if (cachedResponse) {
      return cachedResponse;
    }
    
    // Fallback to index page
    return await caches.match('/');
  }
}

// Check if file is static
function isStaticFile(pathname) {
  const staticExtensions = ['.css', '.js', '.png', '.jpg', '.jpeg', '.gif', '.svg', '.ico', '.webp'];
  return staticExtensions.some(ext => pathname.endsWith(ext));
}

// Handle offline fallback
async function handleOfflineFallback(request) {
  const url = new URL(request.url);
  
  // For images, return a placeholder
  if (url.pathname.match(/\.(png|jpg|jpeg|gif|svg)$/)) {
    return new Response(
      '<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg"><rect width="200" height="200" fill="#f0f0f0"/><text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="#999">Image not available offline</text></svg>',
      { headers: { 'Content-Type': 'image/svg+xml' } }
    );
  }
  
  // For other files, return a basic offline page
  return new Response(
    `<!DOCTYPE html>
    <html>
    <head>
      <title>Zohoor Al Shafa - Offline</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        .offline-message { color: #666; }
      </style>
    </head>
    <body>
      <h1>Zohoor Al Shafa</h1>
      <p class="offline-message">You are currently offline. Some features may not be available.</p>
    </body>
    </html>`,
    { headers: { 'Content-Type': 'text/html' } }
  );
}

// Background sync for when connection is restored
self.addEventListener('sync', (event) => {
  if (event.tag === 'menu-sync') {
    event.waitUntil(syncMenuData());
  }
});

// Sync menu data when connection is restored
async function syncMenuData() {
  try {
    const response = await fetch('/api/menu');
    if (response.ok) {
      const cache = await caches.open(DYNAMIC_CACHE);
      await cache.put('/api/menu', response);
      console.log('Service Worker: Menu data synced successfully');
    }
  } catch (error) {
    console.error('Service Worker: Failed to sync menu data', error);
  }
}

// Push notifications (for future use)
self.addEventListener('push', (event) => {
  if (event.data) {
    const data = event.data.json();
    const options = {
      body: data.body,
      icon: '/images/1.pdf.png',
      badge: '/images/1.pdf.png',
      vibrate: [100, 50, 100],
      data: {
        dateOfArrival: Date.now(),
        primaryKey: 1
      }
    };
    
    event.waitUntil(
      self.registration.showNotification(data.title, options)
    );
  }
});

// Notification click handler
self.addEventListener('notificationclick', (event) => {
  event.notification.close();
  
  event.waitUntil(
    clients.openWindow('/')
  );
});
