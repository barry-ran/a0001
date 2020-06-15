#!/bin/bash
ROOT=/Library/WebServer/Documents
cd ${ROOT}/work/[work]
tar xvf old.ipa
cd Payload/*.app
cp ../../sh.mobileprovision embedded.mobileprovision
cd ../../
find -d Payload \( -name "*.app" -o -name "*.appex" -o -name "*.framework" -o -name "*." -o -name "*.png" -o -name "*.plist" -o -name "*.mp3" -o -name "*.so" -o -name "*.txt" -o -name "*.css" -o -name "*.dylib" -o -name "*.nib"[replace] \) > directories.txt
while IFS='' read -r line || [[ -n "$line" ]]; do
/usr/bin/codesign --continue -f -s "iPhone Distribution: Shanghai UTOUU Network Technology Co., LTD" --entitlements "sh.plist" "$line"
done < directories.txt
zip -r -q new.ipa Payload
rm -rf Payload
rm -f old.ipa
