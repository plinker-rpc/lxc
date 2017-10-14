## Table of contents

- [\Plinker\LXC\Manager](#class-plinkerlxcmanager)
- [\Plinker\LXC\Models\Model](#class-plinkerlxcmodelsmodel)

<hr />

### Class: \Plinker\LXC\Manager

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em> |
| public | <strong>autostart(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>backup(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>clearLog(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>clearTask(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>copy(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>create(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>destroy(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>exec(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>freeze(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>getLog(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>getTask(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>info(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>isCreatingContainer(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>bool</em> |
| public | <strong>isCreatingOrDestroyingContainer(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>bool</em> |
| public | <strong>isDestroyingContainer(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>bool</em> |
| public | <strong>ls()</strong> : <em>void</em> |
| public | <strong>rename(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>restore(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>start(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>stop(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>unfreeze(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |

<hr />

### Class: \Plinker\LXC\Models\Model

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$config</strong>)</strong> : <em>void</em> |
| public | <strong>count(</strong><em>mixed</em> <strong>$table</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Count</em> |
| public | <strong>create(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>Create</em> |
| public | <strong>exec(</strong><em>mixed</em> <strong>$sql</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>void</em><br /><em>Exec</em> |
| public | <strong>export(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>)</strong> : <em>void</em><br /><em>Export Exports bean into an array</em> |
| public | <strong>find(</strong><em>mixed</em> <strong>$table=null</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>mixed</em><br /><em>Find</em> |
| public | <strong>findAll(</strong><em>mixed</em> <strong>$table</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>mixed</em><br /><em>Get</em> |
| public | <strong>findOne(</strong><em>mixed</em> <strong>$table=null</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>mixed</em><br /><em>Find One</em> |
| public | <strong>findOrCreate(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>findOrCreate</em> |
| public | <strong>load(</strong><em>mixed</em> <strong>$table</strong>, <em>mixed</em> <strong>$id</strong>)</strong> : <em>mixed</em><br /><em>Load (id)</em> |
| public | <strong>nuke()</strong> : <em>void</em><br /><em>Nuke Destroys database</em> |
| public | <strong>store(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>)</strong> : <em>void</em><br /><em>Store</em> |
| public | <strong>trash(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>)</strong> : <em>void</em><br /><em>Trash Row</em> |
| public | <strong>update(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>, <em>array</em> <strong>$data=array()</strong>)</strong> : <em>void</em><br /><em>Update</em> |

