# Using HMVC Design pattern split every category of project to separate module

### Eveny components contains :
  - Controllers
  - DB migrations,
  - Components
  - Models
  - Routes
  - View

Using this package you can use any of your modules for any other project for one step only

**Commands**
  - Create new Modules
    - ``` php artisan module:create ModuleName ```
  - Create new model , migration , controller , component , resource , request
    - ``` php artisan module make model ModelName --m=User ```
    - ``` --m ``` to select specific components to run command on it
