<?php
/*
 +------------------------------------------------------------------------+
 | Plinker-RPC PHP                                                        |
 +------------------------------------------------------------------------+
 | Copyright (c)2017-2018 (https://github.com/plinker-rpc/core)           |
 +------------------------------------------------------------------------+
 | This source file is subject to MIT License                             |
 | that is bundled with this package in the file LICENSE.                 |
 |                                                                        |
 | If you did not receive a copy of the license and are unable to         |
 | obtain it through the world-wide-web, please send an email             |
 | to license@cherone.co.uk so we can send you a copy immediately.        |
 +------------------------------------------------------------------------+
 | Authors: Lawrence Cherone <lawrence@cherone.co.uk>                     |
 +------------------------------------------------------------------------+
 */
 
namespace Plinker\LXC;

use RedBeanPHP\R;
use Opis\Closure\SerializableClosure;

/**
 *
 */
class Manager
{

    /**
     *
     */
    public function __construct(array $config = array())
    {
        $this->config = $config;

        // load models
        $this->model = new Models\Model($this->config['database']);
    }

    /**
     *
     */
    public function stop($params = array())
    {
        if (empty($params[0])) {
            throw new \Exception('Error: Container name parameter missing. $plink->stop(\'container_name\');');
        }
        
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'stop',
            'token' => hash('sha256', 'stop.'.$params[0]),
            'container' => [
                'name' => $params[0],
                'data' => null
            ]
        ];

        try {
            // find container by name
            $container_row = $this->model->findOne('container', 'name = ?', [$response['container']['name']]);

            // check already exists
            if (empty($container_row->id)) {
                throw new \Exception('Container '.$response['container']['name'].' does not exist');
            }

            // set task
            $response['task'] = $this->model->findOrCreate([
                'tasks',
                'action' => 'stop',
                'completed' => '',
                'container' => $response['container']['name'],
                'params' => json_encode([
                    'token' => $response['token'],
                    'name' => $response['container']['name'],
                ])
            ]);

            // tasks already set
            if (!empty($response['task']->token)) {
                $response['msg'] = 'Stop container task already in queue';
                throw new \Exception('Container '.$response['container']['name'].' is being stopped');
            }
            
            // task added to queue
            else {
                $response['task']->token = $response['token'];
                $response['msg'] = 'Stop container task added to queue';
                $this->model->store($response['task']);
                
                //$container_row->state = 'STOPPING';
                //$this->model->store($container_row);
            }
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function start($params = array())
    {
        if (empty($params[0])) {
            throw new \Exception('Error: Container name parameter missing. $plink->stop(\'container_name\');');
        }
        
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'start',
            'token' => hash('sha256', 'start.'.$params[0]),
            'container' => [
                'name' => $params[0],
                'data' => null
            ]
        ];

        try {
            // find container by name
            $container_row = $this->model->findOne('container', 'name = ?', [$response['container']['name']]);

            // check already exists
            if (empty($container_row->id)) {
                throw new \Exception('Container '.$response['container']['name'].' does not exist');
            }

            // set task
            $response['task'] = $this->model->findOrCreate([
                'tasks',
                'action' => 'start',
                'completed' => '',
                'container' => $response['container']['name'],
                'params' => json_encode([
                    'token' => $response['token'],
                    'name' => $response['container']['name']
                ])
            ]);

            // tasks already set
            if (!empty($response['task']->token)) {
                $response['msg'] = 'Start container task already in queue';
                throw new \Exception('Container '.$response['container']['name'].' is being started');
            }
            
            // task added to queue
            else {
                $response['task']->token = $response['token'];
                $response['msg'] = 'Start container task added to queue';
                $this->model->store($response['task']);
                
                //$container_row->state = 'STARTING';
                //$this->model->store($container_row);
            }
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function destroy($params = array())
    {
        if (empty($params[0])) {
            throw new \Exception('Error: Container name parameter missing. $plink->destroy(\'container_name\');');
        }
        
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'destroy',
            'token' => hash('sha256', 'destroy.'.$params[0]),
            'container' => [
                'name' => $params[0],
                'data' => null
            ]
        ];

        try {
            // find container by name
            $container_row = $this->model->findOne('container', 'name = ?', [$response['container']['name']]);

            // check already exists
            if (empty($container_row->id)) {
                throw new \Exception('Container '.$response['container']['name'].' does not exist');
            }

            // set task
            $response['task'] = $this->model->findOrCreate([
                'tasks',
                'action' => 'destroy',
                'completed' => '',
                'container' => $response['container']['name'],
                'params' => json_encode([
                    'token' => $response['token'],
                    'name' => $response['container']['name']
                ])
            ]);

            // tasks already set
            if (!empty($response['task']->token)) {
                $response['msg'] = 'Destroy container task already in queue';
                throw new \Exception('Container '.$response['container']['name'].' is being destroyed');
            }
            
            // task added to queue
            else {
                $response['task']->token = $response['token'];
                $response['msg'] = 'Destroy container task added to queue';
                $this->model->store($response['task']);
                
                //$container_row->state = 'DESTROYING';
                $this->model->trash($container_row);
            }
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function freeze($params = array())
    {
        if (empty($params[0])) {
            throw new \Exception('Error: Container name parameter missing. $plink->stop(\'container_name\');');
        }
        
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'freeze',
            'token' => hash('sha256', 'freeze.'.$params[0]),
            'container' => [
                'name' => $params[0],
                'data' => null
            ]
        ];

        try {
            // find container by name
            $container_row = $this->model->findOne('container', 'name = ?', [$response['container']['name']]);

            // check already exists
            if (empty($container_row->id)) {
                throw new \Exception('Container '.$response['container']['name'].' does not exist');
            }

            // set task
            $response['task'] = $this->model->findOrCreate([
                'tasks',
                'action' => 'freeze',
                'completed' => '',
                'container' => $response['container']['name'],
                'params' => json_encode([
                    'token' => $response['token'],
                    'name' => $response['container']['name']
                ])
            ]);

            // tasks already set
            if (!empty($response['task']->token)) {
                $response['msg'] = 'Freeze container task already in queue';
                throw new \Exception('Container '.$response['container']['name'].' is being frozen');
            }
            
            // task added to queue
            else {
                $response['task']->token = $response['token'];
                $response['msg'] = 'Freeze container task added to queue';
                $this->model->store($response['task']);
                
                //$container_row->state = 'FREEZING';
                //$this->model->store($container_row);
            }
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function unfreeze($params = array())
    {
        if (empty($params[0])) {
            throw new \Exception('Error: Container name parameter missing. $plink->stop(\'container_name\');');
        }
        
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'unfreeze',
            'token' => hash('sha256', 'unfreeze.'.$params[0]),
            'container' => [
                'name' => $params[0],
                'data' => null
            ]
        ];

        try {
            // find container by name
            $container_row = $this->model->findOne('container', 'name = ?', [$response['container']['name']]);

            // check already exists
            if (empty($container_row->id)) {
                throw new \Exception('Container '.$response['container']['name'].' does not exist');
            }

            // set task
            $response['task'] = $this->model->findOrCreate([
                'tasks',
                'action' => 'unfreeze',
                'completed' => '',
                'container' => $response['container']['name'],
                'params' => json_encode([
                    'token' => $response['token'],
                    'name' => $response['container']['name']
                ])
            ]);

            // tasks already set
            if (!empty($response['task']->token)) {
                $response['msg'] = 'Unfreeze container task already in queue';
                throw new \Exception('Container '.$response['container']['name'].' is being thawed');
            }
            
            // task added to queue
            else {
                $response['task']->token = $response['token'];
                $response['msg'] = 'Unfreeze container task added to queue';
                $this->model->store($response['task']);
                
                //$container_row->state = 'THAWING';
                //$this->model->store($container_row);
            }
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function rename($params = array())
    {
        if (empty($params[0])) {
            throw new \Exception('Error: Container name parameter missing. $plink->stop(\'container_name\', \'new_name\');');
        }
        
        if (empty($params[1])) {
            throw new \Exception('Error: Containers new name parameter missing. $plink->stop(\'container_name\', \'new_name\');');
        }
        
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'rename',
            'token' => hash('sha256', 'rename.'.$params[0]),
            'container' => [
                'name' => $params[0],
                'new_name' => $params[1],
                'data' => null
            ]
        ];

        try {
            // find container by name
            $container_row = $this->model->findOne('container', 'name = ?', [$response['container']['name']]);

            // check already exists
            if (empty($container_row->id)) {
                throw new \Exception('Container '.$response['container']['name'].' does not exist');
            }

            // set task
            $response['task'] = $this->model->findOrCreate([
                'tasks',
                'action' => 'rename',
                'completed' => '',
                'container' => $response['container']['name'],
                'params' => json_encode([
                    'token' => $response['token'],
                    'name' => $response['container']['name'],
                    'new_name' => $response['container']['name'],
                ])
            ]);

            // tasks already set
            if (!empty($response['task']->token)) {
                $response['msg'] = 'Rename container task already in queue';
                throw new \Exception('Container '.$response['container']['name'].' is being renamed');
            }
            
            // task added to queue
            else {
                $response['task']->token = $response['token'];
                $response['msg'] = 'Rename container task added to queue';
                $this->model->store($response['task']);
                
                //$container_row->state = 'RENAMING';
                //$this->model->store($container_row);
            }
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function backup($params = array())
    {
        return 'Not currently implemented';
    }
    
    /**
     *
     */
    public function restore($params = array())
    {
        return 'Not currently implemented';
    }
    
    /**
     *
     */
    public function copy($params = array())
    {
        return 'Not currently implemented';
    }
    
    /**
     *
     */
    public function exec($params = array())
    {
        return 'Not currently implemented';
    }

    /**
     *
     */
    public function autostart($params = array())
    {
        if (empty($params[0])) {
            throw new \Exception('Error: Container name parameter missing. $plink->autostart(\'container_name\');');
        }
        
        if (empty($params[1])) {
            throw new \Exception('Error: Missing value. $plink->autostart(\'container_name\');');
        }
        
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'autostart',
            'token' => hash('sha256', 'autostart.'.$params[0]),
            'container' => [
                'name' => $params[0],
                'value' => ($params[1] == 'YES' ? 'NO' : 'YES'),
                'data' => null
            ]
        ];

        try {
            // find container by name
            $container_row = $this->model->findOne('container', 'name = ?', [$response['container']['name']]);

            // check already exists
            if (empty($container_row->id)) {
                throw new \Exception('Container '.$response['container']['name'].' does not exist');
            }

            // set task
            $response['task'] = $this->model->findOrCreate([
                'tasks',
                'action' => 'autostart',
                'completed' => '',
                'container' => $response['container']['name'],
                'params' => json_encode([
                    'token' => $response['token'],
                    'name' => $response['container']['name'],
                    'value' => $response['container']['value'],
                ])
            ]);

            // tasks already set
            if (!empty($response['task']->token)) {
                $response['msg'] = 'Autostart container task already in queue';
                throw new \Exception('Container '.$response['container']['name'].' is being stopped');
            }
            
            // task added to queue
            else {
                $response['task']->token = $response['token'];
                $response['msg'] = 'Autostart container task added to queue';
                $this->model->store($response['task']);
            }
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function ls()
    {
        //set task
        $t = $this->model->findOrCreate([
            'tasks',
            'action' => 'update',
            'params' => json_encode([])
        ]);

        //
        return $this->model->findAll('container');
    }
    
    /**
     *
     */
    public function info($params = array())
    {
        //
        return $this->model->findOne('container', 'id = ?', [$params[0]]);
    }

    /**
     *
     */
    public function create($params = array())
    {
        if (empty($params[0])) {
            throw new \Exception('Error: Container name parameter missing. $plink->create(\'container_name\');');
        }

        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'create',
            'token' => hash('sha256', 'create.'.$params[0]),
            'container' => [
                'name' => $params[0],
                'data' => null
            ]
        ];

        try {
            // find container by name
            $container_row = $this->model->findOne('container', 'name = ?', [$response['container']['name']]);

            // check already exists
            if (!empty($container_row->id)) {
                $response['container']['data'] = $container_row;
                
                // linking recovery - has no task token
                if (empty($container_row->token)) {
                    $container_row->token = $response['token'];
                    $this->model->store($container_row);
                }
                
                throw new \Exception('Container '.$response['container']['name'].' already exists');
            }

            // set task
            $response['task'] = $this->model->findOrCreate([
                'tasks',
                'action' => 'create',
                'completed' => '',
                'container' => $response['container']['name'],
                'params' => json_encode([
                    'token' => $response['token'],
                    'name' => $response['container']['name']
                ])
            ]);

            // tasks already set
            if (!empty($response['task']->token)) {
                $response['msg'] = 'Create container task already in queue';
                throw new \Exception('Container '.$response['container']['name'].' is being created');
            }
            
            // task added to queue
            else {
                $response['task']->token = $response['token'];
                $response['msg'] = 'Create container task added to queue';
                $this->model->store($response['task']);
            }
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function getLog($params = array())
    {
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'getLog',
            'token' => hash('sha256', 'log.'.@$params[0]),
            'data' => []
        ];

        try {
            //
            if (!empty($params[0])) {
                $container = $this->model->findOne('container', 'id = ?', [$params[0]]);
                $response['data'] = \RedBeanPHP\R::exportAll($this->model->find('log', 'container = ?', [$container->name]));
            } else {
                $response['data'] = \RedBeanPHP\R::exportAll($this->model->find('log'), true);
            }
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function clearLog($params = array())
    {
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'clearLog',
            'token' => hash('sha256', 'clearlog.'.@$params[0]),
            'data' => []
        ];

        try {
            //
            if (!empty($params[0])) {
                $response['data'] = $this->model->exec('DELETE FROM log WHERE container = ?', [$params[0]]);
            } else {
                $response['data'] = $this->model->exec('DELETE FROM log');
            }
            
            $response['data'] = [];
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
       
    /**
     *
     */
    public function getTask($params = array())
    {
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'getLog',
            'token' => hash('sha256', 'task.'.@$params[0]),
            'data' => []
        ];

        try {
            //
            if (!empty($params[0])) {
                $container = $this->model->findOne('container', 'id = ?', [$params[0]]);
                $response['data'] = \RedBeanPHP\R::exportAll($this->model->findAll('tasks', 'container = ?', [$container->name]));
            } else {
                $response['data'] = \RedBeanPHP\R::exportAll($this->model->find('tasks'));
            }
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function isCreatingOrDestroyingContainer($params = array())
    {
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'isCreatingOrDestroyingContainer',
            'token' => hash('sha256', 'isCreatingContainer'.@$params[0]),
            'data' => []
        ];

        try {
            //
            $response['data'] = \RedBeanPHP\R::exportAll($this->model->find('tasks', '(action = "create" OR action = "destroy") AND completed = ""'));
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function isCreatingContainer($params = array())
    {
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'isCreatingContainer',
            'token' => hash('sha256', 'isCreatingContainer'.@$params[0]),
            'data' => []
        ];

        try {
            //
            $response['data'] = \RedBeanPHP\R::exportAll($this->model->find('tasks', 'action = "create" AND completed = ""'));
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
    
    /**
     *
     */
    public function isDestroyingContainer($params = array())
    {
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'isDestroyingContainer',
            'token' => hash('sha256', 'isDestroyingContainer'.@$params[0]),
            'data' => []
        ];

        try {
            //
            $response['data'] = \RedBeanPHP\R::exportAll($this->model->find('tasks', 'action = "destroy" AND completed = ""'));
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }
        
    /**
     *
     */
    public function clearTask($params = array())
    {
        //
        $response = [
            'error' => false,
            'msg' => null,
            'action' => 'clearTask',
            'token' => hash('sha256', 'clearTask.'.@$params[0]),
            'data' => []
        ];

        try {
            //
            if (!empty($params[0])) {
                $response['data'] = $this->model->exec('DELETE FROM tasks WHERE container = ?', [$params[0]]);
            } else {
                $response['data'] = $this->model->exec('DELETE FROM tasks');
            }
            
            $response['data'] = [];
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['msg'] = $e->getMessage();
        }

        //
        return $response;
    }

//    public function helloClosure($params = array())
//    {
//        $test = function ($what) {
//            return $what.' - Thanks buddy...';
//        };
//
//        return new SerializableClosure($test);
//    }
}
