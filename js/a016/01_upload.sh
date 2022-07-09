#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../a016 amaraimusi@amaraimusi.sakura.ne.jp:www/sample/js
rsync -auvz ../index.html amaraimusi@amaraimusi.sakura.ne.jp:www/sample/js
rsync -auvz ../../index.html amaraimusi@amaraimusi.sakura.ne.jp:www/sample


echo "------------ 送信完了"
#cmd /k