#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../type_script amaraimusi@amaraimusi.sakura.ne.jp:www/sample/
rsync -auvz ../index.html amaraimusi@amaraimusi.sakura.ne.jp:www/sample/

echo "------------ 送信完了"
#cmd /k