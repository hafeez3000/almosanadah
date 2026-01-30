cd\
cd C:\Program Files\PostgreSQL\8.1\bin
pg_dump.exe -i -h localhost -p 5432 -U postgres -F c -b -v -f "D:\dorserpbackup\dorserp.backup" dorserp