RSYNC = rsync -avz
RHOST = bijoufrench
RFILES = /var/www/vhosts/bijoufrench.com/api/data.bijoufrench.com/public/storage/files

LDB = bijoufrench
RDB = bijoufrench
RDBDIR = /var/www/vhosts/bijoufrench.com/api/data.bijoufrench.com/dbs
LDBDIR = ./dbs

MYSQL = mysql --login-path='local'
MYSQLDUMP = mysqldump --login-path='local'

DATE = $(shell date +%H.%M.%S_%d-%m-%Y)



downup:
	$(RSYNC) $(RHOST):$(RFILES) ./public/storage


downdb:
	ssh $(RHOST) "mkdir -p $(RDBDIR); cd $(RDBDIR); $(MYSQLDUMP) $(RDB) | gzip > $(RDB).sql.gz"
	mkdir -p ./dbs
	$(RSYNC) $(RHOST):$(RDBDIR)/$(RDB).sql.gz ./dbs
	gunzip -f ./dbs/$(RDB).sql.gz
	$(MYSQL) -e "DROP DATABASE IF EXISTS $(LDB); CREATE DATABASE $(LDB)"
	$(MYSQL) $(LDB) < ./dbs/$(RDB).sql

updb:
	$(MYSQLDUMP) $(LDB) | gzip > ./dbs/$(LDB)-$(DATE).sql.gz
	$(RSYNC) ./dbs/$(LDB)-$(DATE).sql.gz $(RHOST):$(RDBDIR)
	ssh $(RHOST) "mkdir -p $(RDBDIR); cd $(RDBDIR); $(MYSQLDUMP) $(RDB) | gzip > $(RDB).sql.gz"
	ssh $(RHOST) "cd $(RDBDIR); gunzip -f $(LDB)-$(DATE).sql.gz; $(MYSQL) -e 'DROP DATABASE IF EXISTS $(RDB); CREATE DATABASE $(RDB)'"
	ssh $(RHOST) "cd $(RDBDIR); $(MYSQL) $(RDB) < $(LDB)-$(DATE).sql"
