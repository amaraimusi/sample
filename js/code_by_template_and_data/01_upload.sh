﻿#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../code_by_template_and_data amaraimusi@amaraimusi.sakura.ne.jp:www/sample/js


echo "------------ 送信完了"
#cmd /k