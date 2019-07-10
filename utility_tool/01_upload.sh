#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../utility_tool amaraimusi@amaraimusi.sakura.ne.jp:www/sample


echo "------------ 送信完了"
#cmd /k