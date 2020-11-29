## 拼多多-多多客API SDK

### 环境要求

- PHP >= 7.0
- Composer
- ext-curl 拓展
- ext-json 拓展

### 安装

```
composer require jassue/pdd-duoduoke
```

### 使用

```php
use Jassue\DuoDuoKe\Client;
require __DIR__ . '/vendor/autoload.php';
$duoduoke = new Client('client_id', 'client_secret');

// 获取爆款排行商品接口
// 方式一
$result = $duoduoke->topGoodsListQuery(); 
// 方式二
$result = $duoduoke->request('pdd.ddk.top.goods.list.query', []);
```

### 相关文档
- [多多客API 官方文档](https://open.pinduoduo.com/application/document/api?id=pdd.ddk.cms.prom.url.generate)

### License
MIT
