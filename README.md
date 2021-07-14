# Staff Manager System

Application to managing of your own staff ;) 

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