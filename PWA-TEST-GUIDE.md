# دليل اختبار PWA - زهور الشفا

## 🧪 اختبار PWA على الكمبيوتر

### 1. اختبار أساسي في Chrome DevTools

#### أ) فتح الموقع:
```
http://localhost:8003
```

#### ب) فتح DevTools:
- اضغط `F12` أو `Ctrl+Shift+I`
- اذهب إلى تبويب **"Application"**

#### ج) فحص Manifest:
- في الجانب الأيسر: **Application** → **Manifest**
- تحقق من:
  - ✅ Name: "Zohoor Al Shafa - Food Menu"
  - ✅ Icons موجودة
  - ✅ Theme color: #472257
  - ✅ Display: standalone

#### د) فحص Service Worker:
- **Application** → **Service Workers**
- تحقق من:
  - ✅ Status: "activated and running"
  - ✅ Scope: "/"
  - ✅ Source: "sw.js"

### 2. اختبار Offline Functionality

#### أ) تفعيل Offline Mode:
1. اذهب إلى تبويب **"Network"**
2. اختر **"Offline"** من القائمة المنسدلة
3. أعد تحميل الصفحة (F5)

#### ب) ما يجب أن يعمل:
- ✅ الموقع يفتح كاملاً
- ✅ القائمة تظهر
- ✅ الصور تظهر
- ✅ تبديل اللغة يعمل
- ✅ التنقل بين الأقسام يعمل
- ✅ مؤشر "You are offline" يظهر

#### ج) فحص Cache:
- **Application** → **Storage** → **Cache Storage**
- يجب أن تجد:
  - `zohoor-static-v1.0.0` (الملفات الثابتة)
  - `zohoor-dynamic-v1.0.0` (بيانات API)

### 3. اختبار PWA Install

#### أ) تثبيت PWA:
1. ابحث عن أيقونة التثبيت في شريط العنوان
2. أو اذهب إلى **Application** → **Manifest** → **Install**
3. اضغط "Install"

#### ب) اختبار التطبيق المثبت:
- افتح التطبيق المثبت
- تأكد من أنه يعمل بدون متصفح
- اختبر Offline mode

### 4. اختبار Lighthouse PWA Audit

#### أ) فتح Lighthouse:
1. في DevTools، اذهب إلى تبويب **"Lighthouse"**
2. اختر **"Progressive Web App"**
3. اضغط **"Generate report"**

#### ب) النتائج المتوقعة:
- ✅ PWA Score: 90+ 
- ✅ ✅ Installable
- ✅ ✅ PWA Optimized
- ✅ ✅ Fast and reliable
- ✅ ✅ Engaging

### 5. اختبار Cache Strategies

#### أ) فحص Static Files Cache:
- **Application** → **Cache Storage** → **zohoor-static-v1.0.0**
- يجب أن تجد:
  - CSS files
  - JS files  
  - Images
  - Manifest

#### ب) فحص API Cache:
- **Application** → **Cache Storage** → **zohoor-dynamic-v1.0.0**
- يجب أن تجد:
  - `/api/menu` response

#### ج) فحص Local Storage:
- **Application** → **Local Storage**
- يجب أن تجد:
  - `zohoor_menu_data`
  - `zohoor_menu_cache_time`
  - `language`

### 6. اختبار Performance

#### أ) فحص Loading Speed:
- **Network** → **Disable cache** → **Reload**
- تحقق من سرعة التحميل

#### ب) فحص Offline Performance:
- **Network** → **Offline** → **Reload**
- يجب أن يفتح فوراً (من Cache)

### 7. اختبار Mobile Simulation

#### أ) تفعيل Mobile View:
- اضغط `Ctrl+Shift+M` أو أيقونة الموبايل
- اختر جهاز (iPhone, Android)

#### ب) اختبار Touch Events:
- اختبر النقر على المنتجات
- اختبر تبديل اللغة
- اختبر التنقل

### 8. اختبار Edge Cases

#### أ) Clear Cache Test:
1. **Application** → **Storage** → **Clear storage**
2. أعد تحميل الصفحة
3. يجب أن يعمل مع تحميل جديد

#### ب) Network Interruption Test:
1. **Network** → **Slow 3G**
2. اختبر التحميل
3. **Network** → **Offline**
4. اختبر Offline mode

## 🎯 معايير النجاح

### ✅ PWA يعمل بشكل صحيح إذا:
1. **Manifest صحيح** - جميع البيانات موجودة
2. **Service Worker نشط** - يعمل بدون أخطاء
3. **Offline يعمل** - الموقع كامل بدون نت
4. **Cache فعال** - الملفات محفوظة
5. **Install prompt** - يمكن تثبيت التطبيق
6. **Lighthouse Score** - 90+ في PWA audit
7. **Performance** - تحميل سريع
8. **Mobile Ready** - يعمل على الموبايل

### ❌ مشاكل شائعة:
- Service Worker لا يسجل
- Manifest غير صحيح
- Cache لا يعمل
- Offline لا يعمل
- Install prompt لا يظهر

## 🔧 حل المشاكل

### إذا لم يعمل Offline:
1. تحقق من Service Worker في Console
2. تحقق من Cache Storage
3. أعد تحميل الصفحة
4. امسح Cache وأعد المحاولة

### إذا لم يظهر Install Prompt:
1. تحقق من Manifest validity
2. تأكد من HTTPS (localhost يعمل)
3. تحقق من PWA criteria
4. استخدم Chrome Canary

## 📱 اختبار على الموبايل

### بعد التأكد من عمل PWA على الكمبيوتر:
1. **Android Chrome:**
   - افتح الموقع
   - ابحث عن "Add to Home Screen"
   - ثبت التطبيق
   - اختبر Offline

2. **iOS Safari:**
   - افتح الموقع
   - Share → Add to Home Screen
   - ثبت التطبيق
   - اختبر Offline

## 🎉 النتيجة المتوقعة

بعد اتباع هذا الدليل، يجب أن تحصل على:
- ✅ PWA يعمل بدون نت
- ✅ تثبيت على الموبايل
- ✅ تجربة سريعة وموثوقة
- ✅ Lighthouse score عالي
