<?php 
	class Search_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		function getstr($string, $length, $encoding  = 'utf-8') {   
		    $string = trim($string);   
		    
		    if($length && strlen($string) > $length) {   
		        //截断字符   
		        $wordscut = '';   
		        if(strtolower($encoding) == 'utf-8') {   
		            //utf8编码   
		            $n = 0;   
		            $tn = 0;   
		            $noc = 0;   
		            while ($n < strlen($string)) {   
		                $t = ord($string[$n]);   
		                if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {   
		                    $tn = 1;   
		                    $n++;   
		                    $noc++;   
		                } elseif(194 <= $t && $t <= 223) {   
		                    $tn = 2;   
		                    $n += 2;   
		                    $noc += 2;   
		                } elseif(224 <= $t && $t < 239) {   
		                    $tn = 3;   
		                    $n += 3;   
		                    $noc += 2;   
		                } elseif(240 <= $t && $t <= 247) {   
		                    $tn = 4;   
		                    $n += 4;   
		                    $noc += 2;   
		                } elseif(248 <= $t && $t <= 251) {   
		                    $tn = 5;   
		                    $n += 5;   
		                    $noc += 2;   
		                } elseif($t == 252 || $t == 253) {   
		                    $tn = 6;   
		                    $n += 6;   
		                    $noc += 2;   
		                } else {   
		                    $n++;   
		                }   
		                if ($noc >= $length) {   
		                    break;   
		                }   
		            }   
		            if ($noc > $length) {   
		                $n -= $tn;   
		            }   
		            $wordscut = substr($string, 0, $n);   
		        } else {   
		            for($i = 0; $i < $length - 1; $i++) {   
		                if(ord($string[$i]) > 127) {   
		                    $wordscut .= $string[$i].$string[$i + 1];   
		                    $i++;   
		                } else {   
		                    $wordscut .= $string[$i];   
		                }   
		            }   
		        }   
		        $string = $wordscut;   
		    }   
		    return trim($string);   
		}


		function getKey($key){
			$newkey = '%';
			for ($i = 0; $i < mb_strlen($key, 'UTF-8'); $i++)
				$newkey = $newkey.mb_substr($key, $i, 1, 'UTF-8').'%';
			return $newkey;
		}

		function getResult(){
			$this->load->helper('safe');
			jd_stopattack();
			$page = 1;$key = '';
			if (array_key_exists('page', $_GET)) $page = $_GET['page'];
			if (array_key_exists('key', $_GET)) $key = $_GET['key'];
			$begin = ($page - 1) * 20;
			$user = $this->session->userdata('username');
			$newkey = $this->getKey($key);
			$condition = "((CONCAT(name, author) LIKE \"$newkey\") AND (subscriber = \"N\" OR subscriber = \"$user\" OR uploader = \"$user\") AND (id > 1))";
			$query = "SELECT * FROM book WHERE $condition LIMIT $begin, 20;";
			if (strlen($key) == 0)
				$query = "SELECT * FROM book WHERE $condition ORDER BY rand();";

			$result = $this->db->query($query)->result();
			$query = "SELECT * FROM book WHERE $condition;";
			$count = $this->db->query($query)->num_rows;
			
			return array("result"=>$result,'key'=>$key,'page'=>$page, 'count'=>$count);
			//return array("result"=>$result,'key'=>$key,'page'=>$page);
		}

		function getUserspaceResult($err = 0){
			$this->load->helper('safe');
			jd_stopattack();
			$user = $this->session->userdata('username');
			$query = "SELECT * FROM book WHERE (subscriber = \"$user\");";
			$result1 = $this->db->query($query)->result();
			$query = "SELECT * FROM book WHERE (uploader = \"$user\" AND subscriber != \"N\");";
			$result2 = $this->db->query($query)->result();
			$query = "SELECT * FROM book WHERE (uploader = \"$user\") ;";
			$result3 = $this->db->query($query)->result();
			$query = "SELECT * FROM book WHERE (uploader = \"$user\" AND finishtime != null) ;";
			$result4 = $this->db->query($query)->result();

			$data = array("result1"=>$result1, "result2"=>$result2, "result3"=>$result3, "result4"=>$result4);
			if ($err == 0) $data['err'] = '';
			if ($err == 1) { 
				$data['err'] = '删除成功!';
				$data['is_success'] = true;
			}
			if ($err == 2) {
				$data['err'] = '删除失败!';
				$data['is_success'] = false;
			}
			if ($err == 3) {
				$data['err'] = '上传成功!';
				$data['is_success'] = true;
			}
			if ($err == 4) {
				$data['err'] = '修改书本信息成功!';
				$data['is_success'] = true;
			}
			return $data;
			//return array("result1"=>$result1, "result2"=>$result2, "result3"=>$result3, "result4"=>$result4);
		}
	}

