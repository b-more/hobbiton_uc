<?php
curl -k --anyauth -u ONTECH:Admin.1234!!! -d
'{"text":"#param#","port":[3],"param":[{"number":"0779205949","te
xt_param":["bj"],"user_id":1},{"number":"0975020473",
"text_param":["ye"],"user_id":2}]}' -H "Content-Type:
application/json" https://gateway_ip/api/send_sms


curl -k --anyauth -u ONTECH:Admin.1234!!! -d '{"text":"testing the single sms","port":[3],"param":[{"number":"0779205949"}]}' -H "Content-Type:application/json" https://102.23.120.245/api/send_sms
