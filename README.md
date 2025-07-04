## lxhp5

### 运行
```
docker run -d \
  --name web \
  -p 8080:80 \
  -v ./web:/var/www/html \
  --restart always \
  ghcr.io/linxiqt/lxhp5
```

> 国内服务器将`ghcr.io`替换成`ghcr.nju.edu.cn`即可。
>
> 端口为`8080`，使用域名反代此端口。
>
> 网站文件在当前路径的`web`目录下持久化存储，支持实时修改。
>
> 仓库支持更新源码自动触发构建