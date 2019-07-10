#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../cors_file_upload amaraimusi@amaraimusi.sakura.ne.jp:www/sample/js/a009


echo "------------ 送信完了"
