# club_management


## Setup
```bash
sudo chown -R $USER:$USER /opt/lampp/htdocs/club_management/
sudo chmod -R 777 /opt/lampp/htdocs/club_management/uploads/
sudo touch /opt/lampp/php/php.ini

# put the lines inside php.ini and restart xampp
file_uploads = On
upload_max_filesize = 32M
post_max_size = 32M


```
