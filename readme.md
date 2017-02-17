## 基于Laravel5.3开发的考勤系统

本项目为毕业设计作品

## 环境需求
. Linux系统  
. Nginx或Apache  
. MySQL3.7  
. PHP7.0  
. redis  
. composer  

## 安装
安装Laravel依赖
```
composer update
```

## 配置
将`.env.example`改名为`.env`  
修改`APP_URL`的值为`http://login.kq.cc`  
修改`SESSION_DRIVER`的值为`redis`  
添加`SESSION_DOMAIN=.kq.cc`  

修改`APP_KEY`的值与<a href="https://github.com/yedanten/laravel-attendance-system">主系统</a>的APP_KEY一致  