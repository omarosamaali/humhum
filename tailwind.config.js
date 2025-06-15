// tailwind.config.js
module.exports = {
  content: [
    './resources/**/*.blade.php', // لملفات Blade
    './resources/**/*.js',       // لملفات JavaScript
    './resources/**/*.vue',      // إذا كنت تستخدم Vue
    // أضف أي مسارات أخرى لملفات قد تحتوي على فئات Tailwind
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};