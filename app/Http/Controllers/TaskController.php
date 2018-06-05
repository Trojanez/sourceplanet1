<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('main', compact('tasks'));
    }

    public function train($id)
    {
        $task = Task::find($id);

        return view('train', compact('task'));
    }

    public function test($id)
    {
        $post=$_POST['editor'];
        if (isset($_POST['editor'])) {
            $test = Task::find($id)->check_code;
            $preCode = '';
            $preCode .= '<?php'."\n";
            $preCode .= $_POST['editor'];
            $preCode .= $test;
            $hand = fopen("code.php", "w");
            fwrite($hand,$preCode);
            fclose($hand);
            $descriptorspec = array(
                0 => array("pipe", "r"),  // stdin - канал, из которого дочерний процесс будет читать
                1 => array("pipe", "w"),  // stdout - канал, в который дочерний процесс будет записывать
                2 => array("pipe", "w") // stderr - файл для записи
            );
            $process = proc_open("php", $descriptorspec, $pipes, null, null);
            if (is_resource($process)) {
                fwrite($pipes[0],$preCode);
                fclose($pipes[0]);
                $result = stream_get_contents($pipes[1]);
                echo "<p class='t1'>".$result."<p>";
                fclose($pipes[1]);
            }

        }
        $task=Task::find($id);
        return view('train', compact('task', 'post'));
    }

    public function create()
    {
        $task = new Task;
        $task->task_desc = $_POST['task_desc'];
        $task->check_code = $_POST['check_code'];
        $task->task_view = $_POST['task_view'];
        $task->save();
        return redirect()->action('TaskController@index');
    }
}
