#!/bin/bash
DATE=`date +%Y-%m-%d_%H-%M`
mysqldump -h mysql3.mydevil.net -u m1147_inf -pZfQoQmFOwrMf6pxFY4r8 m1147_abi > /home/Informatics/domains/abi.informatics.jaworzno.pl/public_html/backup_sql/abi_$DATE.sql
tar cvfj /home/Informatics/domains/abi.informatics.jaworzno.pl/public_html/backup_sql/abi_$DATE.tgz /home/Informatics/domains/abi.informatics.jaworzno.pl/public_html/backup_sql/abi_$DATE.sql
rm -f /home/Informatics/domains/abi.informatics.jaworzno.pl/public_html/backup_sql/abi_$DATE.sql

