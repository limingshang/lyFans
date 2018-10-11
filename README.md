### 第一步
#### 1、执行
    composer install            # 初始化安装
    php artisan key:generate    # 创建生成APP_KEY
#### 2、修改 .env 文件
    配置.env 文件
#### 3、执行创建表
    报错如下 
    [Illuminate\Database\QueryException] 
    SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes (SQL: alter table users add unique users_email_unique(email)) 
    [PDOException] 
    SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes 
    Laravel5.4及以上版本 默认使用 utf8mb4 字符，包括支持在数据库存储「表情」。如果你正在运行的 MySQL release 版本低于5.7.7 或 MariaDB release 版本低于10.2.2 ，为了MySQL为它们创建索引，你可能需要手动配置迁移生成的默认字符串长度，
    
    这时候打开项目下的app\Providers\AppServiceProvider.php 文件 
    引入 use Illuminate\Support\Facades\Schema; 
    然后在 boot 方法添加一行代码 
            Schema::defaultStringLength(191); 
     重新执行迁移即可
#### 4、利用命令创建表
    1.执行创建表命令
        php artisan make:migration create_tableName_table
    2.修改database下migrations内具体表字段
    3.执行表操作
        php artisan migrate
    4.如果感觉那里不正确需要回滚
        php artisan migrate:rollback
    5.修改表字段
        https://segmentfault.com/q/1010000007302956

#### 5.增加数据
    1.创建一个填充文件
        php artisan make:seeder tableSeeder
    2.文件内写入查询构造器
        DB:table('tableName')->insert([
            ['colom'  => 'value'],
            ['colom2' => 'value'],
        ])
    3.执行查询构造器插入数据
        php artisan db::send --class=tableSeeder
#### 6.创建controller model 命令
    1.创建控制器
        php artisan make:controller Module/TestController
    2.创建模型
        php artisan make:model Model/TestModel
        
#### 7.Laravel 自定义公共函数的引入
    https://blog.csdn.net/u011415782/article/details/78925048
