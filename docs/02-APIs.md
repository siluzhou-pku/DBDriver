# APIs

本文档将提供DBDriver API 介绍

## Interface DbInterface
### Description

Dbdriver Interface

- author: Silu Zhou <siluzhou_pku@163.com>
- version: 3.3

*Located in /DBDriver/DbInterface.php (line 17)*

### Method Summary

	
	
- void beginTransaction ()
- void close ()
- void commit ()
- boolean/obj delete (string $table, string $where)
- void getAll ( $sql,  $field)
- void getCol (string $sql)
- void getMap (string $sql)
- void getOne (string $sql)
- void getRow (string $sql)
- boolean/obj insert (string $table, array $values)
- void lastInsert ()
- void query (string $sql)
- void queryCount ()
- void rollBack ()
- void update (string $table, array $values, string $where)
- void version ()


### Methods



#### beginTransaction (line 22)

begin transaction

   - access: public

void beginTransaction ()


#### close (line 101)

close database

- access: public

void close ()


#### commit (line 26)

commit transaction

- access: public

void commit ()



#### delete (line 67)

delete database

   - access: public

boolean/obj delete (string $table, string $where)

  -  string $table	
  -  string $where	



#### getAll (line 71)

execute SQL statements

- access: public

 void getAll ( $sql,  $field)

   - $sql	
   - $field	


#### getCol (line 84)

execute SQL statements

- access: public

void getCol ( $sql)

- $sql	


#### getMap (line 90)

execute SQL statements

- access: public

void getMap ( $sql)

- $sql	

#### getOne (line 96)

execute SQL statements

- access: public

void getOne ( $sql)

- $sql	

#### getRow (line 78)

execute SQL statements

- access: public

void getRow ( $sql)

- $sql	


#### insert (line 58)

insert database

 -   access: public

boolean/obj insert (string $table, array $values)

  -  string $table	
  -  array $values	



#### lastInsert (line 38)

return the last inserted ID

   - access: public

void lastInsert ()



#### query (line 44)

operate database

   - access: public

void query (string $sql)

   - string $sql	


#### queryCount (line 34)

return times of accessing database

   - access: public

void queryCount ()
#### rollBack (line 30)

rollback transaction

   - access: public

void rollBack ()


#### update (line 51)

update database

  -  access: public

void update (string $table, array $values, string $where)

  -  string $table	
  -  array $values	
  -  string $where	


#### version (line 106)

return current version of class db

  -  access: public

void version ()
