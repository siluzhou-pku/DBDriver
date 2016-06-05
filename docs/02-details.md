# Details of DBDriver

本文档将提供DBDriver详细的技术细节

## Interface
```
interface Dbinterface
{
    public function query($sql);
    public function getAll($sql);
    public function getRow($sql);
    public function getCol($sql);
    public function getMap($sql);
    public function getOne($sql);
	public function close();
}
```




