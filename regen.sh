curl -u family:123456 https://localhost/gen.php -k > index.php
find photos/ | grep "/small/" | grep JPG | grep -v "2014_12_26_Cocktails" | grep -v "2015_02_Syracuse" > allfiles
