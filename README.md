**Step to run the container**
1. Clone this repo to your computer
   ```
   cd d:\dev\
   git clone git@github.com:raheemumt/mynemo-fyp.git 
   ```
   
2. Run ```docker compose up -d --build``` for running this app

3. Open browser. access to ```http://localhost``` to run the mynemo portal

4. access to ```http://localhost/sample``` to run the sample system

**For custom path**

1) edit file compose.yml...

 create new folder outside mynemo-fyp directory: For example
 ```
 d:/dev/myProjek
```
> comment (#) or remove line 58
> edit line 61 ->
```
> /run/desktop/mnt/host/d/dev/myProjek:/var/www/html/public/
```

configuration should be as below: 

```
app-mount:
    image: ismearab/appnemo
    hostname: app-mount
    #container_name: app-benchfee
    #ports:
    #  - "10002:80"  # Adjust port as needed
    volumes:
    
      #adjust your belonging here  
      #- ./app-sample:/var/www/html/public/  # Mount point to Dev folder
      # Mount point to any apps folder 
      # eg: D:\dev\ekonferensi
      /run/desktop/mnt/host/d/dev/myProjek:/var/www/html/public/
      
      ###################################
      #start core framework.. dont touch them..
      - ./coreapp/system:/core-ci/ci3/system # Mount volume to application system in the container
      - ./coreapp/apps-dist/third_party:/var/www/html/public/application/third_party # Mount volume to application system in the container
      - ./coreapp/apps-dist/vendor:/var/www/html/public/application/vendor # Mount volume to application system in the container
      - ./coreapp/www-public/assets:/var/www/html/public/assets/monster # Mount volume to asset/template folder in the container
      - ./www-uploads:/www-uploads # Mount volume to www-upload in the container
      - ./coreapp/tmp:/tmp # Mount volume to tmp (for session) in the container
      #end core
      ###################################
    restart: unless-stopped

    ------------------
 ```
2) docker compose up -d --build
3) edit file custom-app-cfg

   put this setting after last line

    ```
   location /my-system/ {
     proxy_pass http://app-mount/;
   }
   ```
   
  
5) run docker exec mynemo-fyp-nginx-proxy-1 nginx -s reload
   OR
   docker compose up -d --build
 
