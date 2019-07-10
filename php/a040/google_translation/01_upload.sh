#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../google_translation amaraimusi@amaraimusi.sakura.ne.jp:www/sample/php/a040


echo "------------ 送信完了"
cmd /k