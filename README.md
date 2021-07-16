# Staff Manager System

Application to managing of your own staff ;) 

[![Check the website online!](https://img.shields.io/website?down_message=Sorry%20we%20stunning%20with%20goblins%20right%20now%20%28page%20offline%29&style=for-the-badge&up_message=Check%20online&url=https%3A%2F%2Fsms.hryszko.dev)](http://sms.hryszko.dev)

--- 

# Installation

**Bash script:**
```
git clone https://gitlab.ideo.pl/s.hryszko/staff-manager.git && 
cd "staff-manager"
composer i || composer install --ignore-platform-reqs || composer install --ignore-platform-reqs && 
if [ ! -f .env ]; then cp .env.example .env; fi
echo "Edit mysql access!" && read && $EDITOR .env
```