## install module

Нужно добавить хук в custom/modules/Opportunities/logic_hooks.php
```
$hook_array['before_save'][] = Array(77, 'checkValidBean', 'modules/Opportunities/checkValidBean.php','checkValidBean', 'validBean'); 
```
