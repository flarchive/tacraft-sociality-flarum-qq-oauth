# Flarum QQ OAuth

面向 **Flarum 2** 的 QQ（腾讯 QQ 互联）登录扩展。

- **包名**：`tacraft-sociality/flarum-qq-oauth`
- **扩展 ID**：`tacraft-sociality-qq-oauth`
- **目标平台**：Flarum `^2.0.2`、PHP `^8.3`
- **许可**：MIT

---

## 功能

- **QQ 登录**：登录与注册弹窗中显示 QQ 登录按钮（未配 App ID / App Key 时自动隐藏）。
- **首次登录即注册**：首次登录带一次性注册令牌回到论坛并自动打开注册弹窗，预填昵称与头像。
- **老用户直接登录**：已绑定 QQ 用户点击后直接登录并跳回原页面。
- **自定义登录图标**：后台可上传 PNG / JPG / GIF / WebP 图片替换内置图标。

---

## 环境要求

| 项 | 要求 |
| --- | --- |
| Flarum | `2.0.2` 及以上 |
| PHP | `8.3` 及以上 |
---

## 安装

在 `composer.json` 中配置仓库地址后执行：

```sh
composer require tacraft-sociality/flarum-qq-oauth:dev-main
php flarum cache:clear
```

---

## 配置 QQ 互联

1. 前往 [QQ 互联](https://connect.qq.com) 创建网站应用。
2. 网站回调域填写：`https://你的域名/auth/qq`（需与论坛实际地址完全一致）。
3. 审核通过后获得 **App ID** 与 **App Key**，填入论坛后台对应设置项。