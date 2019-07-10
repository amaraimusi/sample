#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../index.html amaraimusi@amaraimusi.sakura.ne.jp:www/sample/js
rsync -auvz ../a008 amaraimusi@amaraimusi.sakura.ne.jp:www/sample/js



echo "------------ 送信完了"
cmd /k