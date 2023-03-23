#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../showModalBigImg amaraimusi@amaraimusi.sakura.ne.jp:www/example_js_k


echo "------------ 送信完了"
#cmd /k