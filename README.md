<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## 项目 首次部署步骤

- Git pull
- 本地安装composer，控制台cd到仓库目录composer install
- 将根目录.env.sample复制为.env 修改里面的MYSQL相关信息
- 执行php artisan key:generate
- 执行php artisan storage:link
- 执行php artisan migrate
- 执行php artisan db:seed

## pull之后的操作

首次部署后，每次pull后只需执行php artisan migrate  
如有新的包加入则执行composer update  
或者新的seed则执行php artisan db:seed --class=指定seeder  

## 测试用户列表：
(用户名#密码)

admin#admin 最高权限  
demo#demo 默认注册用户  
banned#banned 被封禁用户  

- 以下为各种管理员，权限见下方User  

sxyl_admin#123456  
xxst_admin#123456   
zttr_xtw#123456  
zttr_tzs#123456  
zttr_tgpx#123456  
zttr_admin#123456   
xywh_admin#123456  


## 模型(表)
以下模型均有自增id、created_at、updated_at三个属性 省略。

### User 用户  

yiban_id 外键 易班用户绑定用  
username/password 用户名密码  
avatar 头像地址 为易班获取的绝对地址  
super_admin   是否拥有最高权限  
sxyl_admin    是否拥有思想引领-主题教育相关全部权限  
xxst_admin    是否拥有思想引领-学习社团相关全部权限  
zttr_xtw      是否拥有基层团建-主题团日相关校团委全部权限  
zttr_tzs      是否拥有基层团建-主题团日相关团支书全部权限  
zttr_tgpx     是否拥有基层团建-团干培训全部权限  
zttr_admin    是否拥有基层团建"上级团组织" 可以管理团组织 拥有基层团建最高权限  
xywh_admin    是否拥有校园文化全部权限  
banned        是否为被封禁用户  

### Activity 活动  

user_id 举办者id  
title 标题  
content 内容（富文本）  
type 活动类型 如：sxyl为思想引领主题活动 yxtx为雁翔团校主题活动 mzy为梦之翼团校主题活动 zttr为主题团日相关活动 tgpx为团干培训活动 xywh为校园文化活动  
community_day_id 可空 若为主题团日活动 其团日id  
start_at 可空 活动开始时间  
check_required 是否需要签到&签退  

### Comment 评论/反馈

user_id 发布者id  
activity_id 对应活动id  
content 内容(字符串)  

### Application 活动报名
user_id 报名者id    
activity_id 报名活动id    
status 状态：0为待审核 1为审核通过 2为审核失败  
verifier_id 审核者id 可空  
verified_at 审核时间  
sign_in 是否签到 默认0  
sign_out 是否签退 默认0  

### CommunityDay 主题团日
name 团日名称  
start_at 开始时间 可空  
end_at 结束时间 可空  

## 路由

- 活动activity：CRUD结构

GET    /activity 活动列表页  
GET    /activity/create 创建活动页  
POST   /activity 创建活动请求  
GET    /activity/{activity} 某活动详情页  
GET    /activity/{activity}/edit 某活动编辑页  
PUT    /activity/{activity} 编辑某活动请求  
DELETE /activity/{activity} 删除某活动请求  

- 评论/反馈 comment:

（评论增删改查均在活动内页采用AJAX）  
POST   /activity/{activity}/comment 创建评论请求  
PUT    /comment/{comment} 编辑某评论请求  
DELETE /comment/{comment} 删除某评论请求  




## 需要向甲方问清楚的事情

1. "活动反馈"的机制：反馈是否在活动结束之后才可提交；是否必须要参加活动才可提交；反馈是否公开给所有用户；若公开是否需要审核；    
2. "问卷"的机制: 题型有哪些；是否一定要填写；是否需要问卷数据可视化；是否需要批量导出等（若有，可能得延长工作时间等）  
3. "线上考试"和"作业"的机制： 题型有哪些；是否需要批量导出等（若有，可能得延长工作时间等）  
4. "活动报名审核"的机制：审核失败是否需要告知驳回理由；  

## 相关教程

- [用户认证](https://laravel-china.org/docs/laravel/5.6/authentication)
- [权限](https://laravel-china.org/docs/laravel/5.6/authorization)
- [前端](https://laravel-china.org/docs/laravel/5.6/blade)


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
