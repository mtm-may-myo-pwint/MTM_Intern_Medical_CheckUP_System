# # Laravel Custom Structure

# # # app/
Laravel ရဲ့ အဓိက Application Logic တွေကို စုထားတဲ့ folder ဖြစ်ပါတယ်။ ဒီထဲမှာ subfolders များစွာရှိပါတယ်။

- Constants/ - GeneralConst.php: App တစ်ခုလုံးမှာ အသုံးပြုတဲ့ constant value (e.g. status codes, user roles) တွေကို ထားရာ file ဖြစ်ပါတယ်။
- Console/ - Artisan command များ (php artisan ...) ကို custom လုပ်ဖို့ Command classes များကို ထားတတ်သည်။
- Exceptions/ - Error/Exception Handling ကို စီမံတဲ့နေရာ။ Handler.php ပါဝင်သည်။

- Http/
- - Controllers/: Controller classes များကို ထားသည်။
- - Controllers/Controller.php: အခြား controller တွေအားလုံးရဲ့ base class ဖြစ်တတ်ပါတယ်။
- - Controllers/UserController.php: User-related action (register, login, edit, delete) တွေကို ထိန်းချုပ်တဲ့ controller ဖြစ်ပါတယ်။
- - Controllers/Auth/: အသုံးပြုသူ authentication တွေနဲ့ဆိုင်တဲ့ controller များထားဖို့နေရာ ဖြစ်နိုင်ပါတယ်။
- - Middleware/: Request တစ်ခုလာသောအခါ ထိန်းချုပ်ရန် middleware များ။
- - Middleware/Authenticate.php: Laravel built-in middleware တစ်ခုဖြစ်ပြီး authentication မရှိရင် login page သို့ redirect လုပ်ပါတယ်။
- - Requests/UserSaveRequest.php: Form validation ကို တိကျဖို့ Form Request Class တစ်ခု ဖြစ်ပါတယ်။ e.g. user register/update data တွေကို validate လုပ်ခြင်း။

- Lib/
- - Lib/DateFormat.php: Custom date formatting logic များကို ထားတဲ့ helper class တစ်ခုဖြစ်နိုင်ပါတယ်။

- Models/
- - Models/Post.php: Post table နဲ့ဆက်နွယ်တဲ့ Eloquent Model
- - Models/User.php: User table နဲ့ဆက်နွယ်တဲ့ Model (users table)

- Providers/
- - Providers/AppServiceProvider.php: Laravel service provider တစ်ခု ဖြစ်နိုင်ပြီး, App bootstrapping အတွက် service binding များလုပ်ပါတယ်။

- Services/: Controller တွေကို ပေါ့ပါးအောင်ထားပြီး logic ကို service class ထဲတွင် centralize ပြုလုပ်ခြင်း။
- - Services/UserService.php: User နဲ့ ပတ်သက်တဲ့ Business Logic (ဥပမာ: custom validation, user-specific permission check, external API call) များကို ထည့်သွင်းထားနိုင်တယ်။


# # # public/
Web Server Access ပြုနိုင်သောနေရာ

- css/
- - css/bootstrap.min.css: Bootstrap CSS library
- - css/jquery-ui.min.css: jQuery UI styling
- - css/reset.css, style.css: သင်ရေးထားတဲ့ Global CSS files

- img/: Website သုံးတဲ့ ပုံများအတွက် folder

- js/
- - js/bootstrap.bundle.min.js: Bootstrap JS bundle
- - js/common.js: Shared Common JS logic
- - js/jquery-3.7.1.min.js, jquery-ui.min.js: jQuery & UI library
- - js/user_list.js: User List-related function JS

- index.php: Laravel app entry point
- .htaccess: Apache server config
- favicon.ico, robots.txt: SEO နှင့် browser support


# # # resources/
- css/, js/: Laravel Mix or Vite မှ Compile ပြုလုပ်မယ့် source files

- views/: Blade Templates
- - auth/: Login, Register စသော auth-related UI

- - includes/
- - includes/common/footer.blade.php, header.blade.php: Shared layout parts (header/footer)
- - includes/common/script.blade.php, style.blade.php: Shared Common JS & CSS include blade
- - includes/modals/: Popup modal blade files

- - layouts/
- - layouts/app.blade.php: Main layout
- - layouts/authApp.blade.php: Login layout

- - user/: User-specific UI layout blades' folder


# # # routes/
- routes/: web.php, api.php စသည်ဖြင့် route definition files


# # # storage/
- storage/: Logs, Cache, File Upload အတွက်


# # # tests/
- tests/: PHP Unit Testing files

# # # others
- .env: App config for current environment

- composer.json: PHP packages list

- package.json: JS packages (Vue/React etc.) list

- artisan: Laravel CLI command file

- .gitignore, .editorconfig: Git နှင့် coding standard

- README.md: Project Description

- vite.config.js: Laravel application တွင် Vite ကိုအသုံးပြုသည့်အခါ frontend asset bundling (JavaScript, CSS, Vue, React…) အတွက် configuration ဖိုင်ဖြစ်ပါတယ်။
