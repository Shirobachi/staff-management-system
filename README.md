# Staff Manager System

Application to managing of your own staff ;) 

[![Check the website online!](https://img.shields.io/website?down_message=Sorry%20we%20stunning%20with%20goblins%20right%20now%20%28page%20offline%29&style=for-the-badge&up_message=Check%20online&url=https%3A%2F%2Fsms.hryszko.dev)](http://sms.hryszko.dev)

--- 

# Installation

**Bash script:**
```
git clone https://gitlab.ideo.pl/s.hryszko/staff-manager.git && 
cd "staff-manager"
sudo apt install php-gd
composer i || composer install --ignore-platform-reqs || composer install --ignore-platform-reqs && 
chmod 775 vendor/mpdf/mpdf/tmp && chmod 777 vendor/mpdf/mpdf/tmp/mpdf
if [ ! -f .env ]; then cp .env.example .env; fi
echo "Edit mysql access!" && read && $EDITOR .env
```

**Also import dumps** 
```
source /storage/app/public/dumps/load_departments.dump;
source /storage/app/public/dumps/load_deptEmp.dump;
source /storage/app/public/dumps/load_deptManagers.dump;
source /storage/app/public/dumps/load_employees.dump;
source /storage/app/public/dumps/load_salaries1.dump;
source /storage/app/public/dumps/load_salaries2.dump;
source /storage/app/public/dumps/load_salaries3.dump;
source /storage/app/public/dumps/load_titles.dump;
```