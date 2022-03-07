<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tkd_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }
/****************************************
로그인사용자
*****************************************/
	function get_compet_options($compet_id){
		return $this->db->get_where('COMPETITION_OPTION', array('COMPET_ID'=>$compet_id))->row();
	}
	function get_setting_animation(){
		return $this->db->get_where('SETTING', array('SET_KIND'=>1))->row();
	}
	function get_setting_show_centername($compet_id){
		return $this->db->get_where('SETTING', array('COMPET_ID'=>$compet_id, 'SET_KIND'=>5))->row();
	}
    function insert_agree($data){
        $values = array(
            'COMPET_ID' => $data['compet_id'] ,
            'CENTER_ID' => $data['center_id'] ,
            'A_DATE' => date("Y-m-d") ,
            'AGREE1' => $data['agree1'] ,
            'AGREE2' => $data['agree2'] ,
            'AGREE3' => $data['agree3'] ,
            'AGREE4' => $data['agree4'] ,
            'AGREE5' => $data['agree5'] ,
         );
         $this->db->insert('REGISTED_CENTER_AGREE', $values);
    }
	function get_youtube_list($compet_id){
		return $this->db->get_where('YOUTUBE_LIVE', array('COMPET_ID'=>$compet_id))->result_array();
	}
	function get_youtube_video($video_id){
		return $this->db->get_where('YOUTUBE_LIVE', array('ID'=>$video_id))->row();
	}
	function update_youtube_link($data){
		$compet_id = $data['compet_id'];
		$this->db->delete('YOUTUBE_LIVE', array('COMPET_ID' => $compet_id));
		$values = array(
            'LINK1' => $data['link1'] ,
            'LINK2' => $data['link1'] ,
			'COMPET_ID' => $compet_id ,
         );
         $this->db->insert('YOUTUBE_LIVE', $values);	
	}
	function check_agree($compet_id, $center_id){
		return $this->db->get_where('REGISTED_CENTER_AGREE', array('COMPET_ID'=>$compet_id, 'CENTER_ID'=>$center_id))->row();
	}
	function get_associations(){
		return $this->db->get_where('ASSOCIATIONS', array('SHOW_LIST'=>1))->result_array();
	}
    function get_associations_siteurl($url){
		return $this->db->get_where('ASSOCIATIONS', array('SITE_URL'=>$url))->result_array();
	}
    function get_associations_info($assoc_id){
		return $this->db->get_where('ASSOCIATIONS', array('ID'=>$assoc_id))->row();
	}
	function check_login($data){
        $login_id = $data['login_id'];
        $login_pass = $data['login_pass'];
		$assoc = $data['assoc_id'];
		return $this->db->get_where('REGISTED_CENTER', array('CENTER_ID'=>$assoc,'EMAIL'=>$login_id, 'LOGIN_PASS'=>$login_pass))->result_array();
    }
	function check_login_judge($data){
        $login_id = $data['login_id'];
        $login_pass = $data['login_pass'];
		$compet_id = $data['compet_id'];
		return $this->db->get_where('JUDGE_ASSIGN_VIEW', array('COMPET_ID'=>$compet_id, 'EMAIL'=>$login_id, 'PWORD'=>$login_pass))->result_array();
    }
	function check_login_amb($data){
        $login_id = $data['login_id'];
        $login_pass = $data['login_pass'];
		$assoc = 36;
		return $this->db->get_where('APPLIED_ATHLETE', array('COMPET_ID'=>$assoc,'E_MAIL'=>$login_id, 'A_JUMIN'=>$login_pass))->result_array();
    }
	function select_login_member($id){
		return $this->db->get_where('REGISTED_CENTER', array('ID'=>$id))->row();
    }
	function get_registed_center($center){
		$assoc = $_SESSION['assoc_id'];
		$this->db->like('CENTER_NAME', $center, 'both');
		return $this->db->get_where('REGISTED_CENTER', array('CENTER_ID'=>$assoc))->result_array();
	}
    function get_active_competition_count(){
		$assoc = $_SESSION['assoc_id'];
        return $this->db->where(array('CENTER_ID'=>$assoc,'IS_ACTIVE', 2))->count_all_results('COMPETITIONS');
    }
	//접수중인 대회선택
    function get_active_competition(){
		$assoc = $_SESSION['assoc_id'];
        return $this->db->get_where('COMPETITIONS', array('CENTER_ID'=>$assoc,'IS_ACTIVE >='=>2))->result_array();
    }
    function get_active_competition2($assoc){
        return $this->db->get_where('COMPETITIONS', array('CENTER_ID'=>$assoc,'IS_ACTIVE'=>2))->result_array();
    }
	//실행중인 대회선택
    function get_online_competition(){
		$assoc_id = $_SESSION['assoc_id'];
		if($assoc_id > 0){
			return $this->db->get_where('COMPETITIONS', array('CENTER_ID'=>$assoc_id, 'IS_ONLINE'=>1))->result_array();
		}else{
			return $this->db->get_where('COMPETITIONS', array('IS_ONLINE'=>1))->result_array();
		}
    }
    function get_assoc_competition($assoc_id){
		$this->db->order_by('S_DATE DESC');
		return $this->db->get_where('COMPETITIONS', array('CENTER_ID'=>$assoc_id))->result_array();
    }
    function get_competition($id){
		return $this->db->get_where('COMPETITIONS', array('ID'=>$id))->row();
	}
    function get_competition_info($id){
		return $this->db->get_where('COMPETITIONS', array('ID'=>$id))->result_array();
	}
    function get_competition_sponsor($id){
		$this->db->order_by('IDX ASC');
		return $this->db->get_where('COMPETITIONS_SPONSOR', array('COMPET_ID'=>$id))->result_array();
	}
    function get_tv_message($msg_id){
		return $this->db->get_where('TV_MESSAGE', array('ID'=>$msg_id))->row();
		/*
		$query = $this->db->get_where('TV_MESSAGE', array('ID'=>$msg_id));
		if (count($query->result()) > 0) {
			return $query->row();
		}
		*/
    }
	/*
	function api_get_competitions(){
		$this->db->order_by('ID', 'DESC');
		$query = $this->db->get('COMPETITIONS');
		$compet = array();
		foreach ($query->result_array() as $item) {
			$detail = array();
			$detail['id'] = $item['ID'];
			$detail['c_name'] = iconv("CP949", "UTF-8", $item['C_NAME']);
			$detail['c_place'] = iconv("CP949", "UTF-8", $item['C_PLACE']);
			$compet[] = $detail;
		}
		return $compet;
	}
	*/
	function get_compet_point_display(){
        $this->db->order_by('ID', 'ASC');
		return $this->db->get('COMPET_POINT_DISPLAY')->result_array();
    }
	function get_jongmok_methode($jongmok_id){
		return $this->db->get_where('APPLIED_JONGMOK', array('ID'=>$jongmok_id))->row();
    }
	function get_jongmok_all($c_id){
		$this->db->order_by('ORDER_IDX', 'ASC');
		return $this->db->get_where('JONGMOK_MIX_VIEW', array('COMPET_ID'=>$c_id))->result_array();
    }
	function get_jongmok_single($c_id){
		$this->db->order_by('ORDER_IDX', 'ASC');
		return $this->db->get_where('JONGMOK_MIX_VIEW', array('COMPET_ID'=>$c_id, 'SINGLE_GROUP'=>1))->result_array();
    }
	function get_jongmok_group($c_id){
		$this->db->order_by('ORDER_IDX', 'ASC');
		return $this->db->get_where('JONGMOK_MIX_VIEW', array('COMPET_ID'=>$c_id, 'SINGLE_GROUP > '=>1))->result_array();
    }
	function get_jongmok_name(){
		return $this->db->get('JONGMOK_NAME')->result_array();
    }
	function select_jongmok($id){
		return $this->db->get_where('JONGMOK_MIX_VIEW', array('ID'=>$id))->result_array();
    }
    function get_weight($cat_id){
        $this->db->order_by('COL_ID', 'ASC');
		return $this->db->get_where('ATHLETE_WEIGHT', array('CATEGORY_ID'=>$cat_id))->result_array();
    }
    function get_category($id){
        $this->db->order_by('ORDER_IDX', 'ASC');
		return $this->db->get_where('CATEGORY_MIX_VIEW', array('JONGMOK_ID'=>$id))->result_array();
    }
    function get_category_by_id($id){
        $this->db->order_by('ORDER_IDX', 'ASC');
		return $this->db->get_where('CATEGORY_MIX_VIEW', array('ID'=>$id))->result_array();
    }
    function get_category_price($id){
        return $this->db->get_where('CATEGORY_MIX_VIEW', array('ID'=>$id))->row();
    }
	function get_category_by($jongmok_id) {
		$this->db->order_by("ORDER_IDX", "ASC");
		$query = $this->db->get_where('CATEGORY_MIX_VIEW', array('JONGMOK_ID'=>$jongmok_id));
		if ($query->result()) {
			$category = array();
			//여러 값을 넘길 때는 array로 필요한 데이트를 추가한다.
			if($_SESSION['country'] == 0){
				$i=0;
				foreach ($query->result() as $item) {
					$i++;
					$num = sprintf('%02d',$i);
					$category[$item->ID] = array(
						iconv("EUC-KR", "UTF-8", $num.'. '.$item->CATEGORY_NAME),
						$item->ATT_PRICE,
						$item->MAN_CNT
					);
				}
			}else{
				$i = 0;
				foreach ($query->result() as $item) {
					$i++;
					$num = sprintf('%02d',$i);
					$category[$item->ID] = array(
						$num.'. '.$item->CATEGORY_NAME_E,
						$item->ATT_PRICE,
						$item->MAN_CNT
					);
				}
			}
            return $category;
        } else {
            return FALSE;
        }
    }
	function get_weight_by($category_id = 1) {
        if ($category_id != NULL) {
			$this->db->order_by('COL_ID', 'ASC');
			$query = $this->db->get_where('ATHLETE_WEIGHT', array('CATEGORY_ID'=>$category_id));
        }else{
			$this->db->order_by('COL_ID', 'ASC');
			$query = $this->db->get('ATHLETE_WEIGHT');
		}
		$weight = array();
		//var_dump($query->result());
        if ($query->result()) {
            foreach ($query->result() as $item) {
                $weight[$item->ID] = array(
                    iconv("EUC-KR", "UTF-8", $item->W_NAME),
                    iconv("EUC-KR", "UTF-8", $item->W_DESC)
                );
            }
            return $weight;
        } else {
            return FALSE;
        }
    }
	function get_athlete_name($name){
		$school_id = $_SESSION['center_id'];
		$query = $this->db->get_where('APPLIED_ATHLETE', array('A_NAME'=>$name, 'SCHOOL_ID'=>$school_id));
		$athlete = array();
		//var_dump($query->result());
		if ($query->result()) {
            foreach ($query->result() as $aname) {
                $athlete[$aname->ID] = array(
                    iconv("EUC-KR", "UTF-8", $aname->A_NAME),
                    iconv("EUC-KR", "UTF-8", $aname->A_JUMIN)
                );
            }
            return $athlete;
        } else {
            return FALSE;
        }
    }
	function get_same_athlete_namejumin($name, $jumin){
		if($_SESSION['KIND2'] == 0){	//0=개인종목, 1=전체종목
			$values = array(
				'COMPET_ID' => $data['compet_id'] ,
				'SCHOOL_ID' => $_SESSION['center_id'] ,
				'A_NAME' => $name ,
				'A_JUMIN' => $jumin ,
				'ATHLETE_CNT' => 1 ,
			);
			return $this->db->get_where('APPLIED_ATHLETE', $values)->num_rows();
		}else{
			$values = array(
				'COMPET_ID' => $data['compet_id'] ,
				'SCHOOL_ID' => $_SESSION['center_id'] ,
				'A_NAME' => $name ,
				'A_JUMIN' => $jumin ,
			);
			return $this->db->get_where('TEAM_VIEW', $values)->num_rows();
		}
    }
	function get_athlete_center($id, $center){
        $athlete = $this->db->get_where('APPLIED_ATHLETE', array('ID'=>$id))->result_array();
        $center = $this->db->get_where('REGISTED_CENTER', array('ID'=>$center))->result_array();
		$data['A_NAME'] = $athlete['A_NAME'];
		$data['CENTER_NAME'] = $center['CENTER_NAME'];
		$data['VIDEO_ID'] = $athlete['VIDEO_ID'];
		$data['COUNTRY_ID'] = $center['COUNTRY_ID'];
		
		return $data;
	}
	function get_athlete_info($id){
        return $this->db->get_where('ATHLETE_MIX_VIEW', array('ID'=>$id))->row();
    }
	function get_athlete_byid($id){
        return $this->db->get_where('APPLIED_ATHLETE', array('ID'=>$id))->row();
    }
    function get_team_byguid($id){
        return $this->db->get_where('APPLIED_ATHLETE_TEAM', array('ATHLETE_GUID'=>$id))->result_array();
    }
    function get_requested_athlete($data){
        $compet_id = $data['compet_id'];
        $center_id = $data['center_id'];
		$this->db->order_by('JONGMOK_ID, CATEGORY_ID, ID');
        return $this->db->get_where('ATHLETE_MIX_VIEW', array('COMPET_ID'=>$compet_id, 'SCHOOL_ID'=>$center_id))->result_array();
    }
    function insert_athlete($data){
        $values = array(
            'COMPET_ID' => $data['compet_id'] ,
            'JONGMOK_ID' => $data['jongmok_id'] ,
            'CATEGORY_ID' => $data['category_id'] ,
            'A_NAME' => $data['ath_name'] ,
            'A_JUMIN' => $data['ath_jumin'] ,
            'A_WEIGHT' => $data['weight_id'] ,
            'A_YEAR' => $data['ath_year'] ,
            'REG_DATE' => date("Y-m-d") ,
            'A_PAYED' => 0 ,
            'SCHOOL_ID' => $data['school_id'] ,
            'ATT_PRICE' => $data['att_price'] ,
			'ATHLETE_CNT' => $data['athlete_cnt'] ,
			'A_GUID' => $data['a_guid'] ,
			//'VIDEO_ID' => $data['video_id'] ,
			'A_PICTURE' => $data['a_picture'],
         );
         $this->db->insert('APPLIED_ATHLETE', $values);
    }
    function insert_team($data){
        $values = array(
            'ATHLETE_ID' => $data['ath_id'] ,
            'A_NAME' => $data['ath_name'] ,
            'A_JUMIN' => $data['ath_jumin'] ,
            'A_YEAR' => $data['ath_year'] ,
            'ATHLETE_GUID' => $data['a_guid'] ,
			'COMPET_ID' => $data['compet_id'] ,
			'SCHOOL_ID' => $data['school_id'] ,
         );
         $this->db->insert('APPLIED_ATHLETE_TEAM', $values);
    }
    function insert_center($data){
        $values = array(
            'CENTER_NAME' => $data['center_name'] ,
            'ADDR1' => $data['area_name'] ,
            'C_AREA' => '' ,
            'TEL' => $data['center_tel'] ,
            'C_GUID' => $data['c_guid'] ,
            'APPROVED' => 1 ,
			'C_NAME' => $data['c_name'] ,
			'MOBILE' => $data['mobile'] ,
			'EMAIL' => $data['email'] ,
			'LOGIN_PASS' => $data['login_pass'] ,
			'REG_DATE' => date("Y-m-d") ,
			'CENTER_ID' => $data['center_id'] ,
			'RECOMMANDER' => $data['recommander'],
			'RECOMMANDER_TEL' => $data['recommander_tel'],
			'COUNTRY_ID' => $data['country_id'],
         );
         $this->db->insert('REGISTED_CENTER', $values);
    }
    function insert_center_member($data){
        $values = array(
            'C_GUID' => $data['c_guid'] ,
            'U_NAME' => $data['u_name'] ,
            'EMAIL' => $data['u_email'] ,
            'LOGIN_PASS' => $data['u_pass'] ,
            'TEL' => $data['u_tel'] ,
            'U_GRADE' => $data['u_grade'] ,
			'REG_DATE' => date("Y-m-d") ,
         );
         $this->db->insert('CENTER_MEMBER', $values);
    }
    function update_center_member($data){
		$id = $data['id'];
        $values = array(
            'C_GUID' => $data['c_guid'] ,
            'U_NAME' => $data['u_name'] ,
            'EMAIL' => $data['u_email'] ,
            'LOGIN_PASS' => $data['u_pass'] ,
            'TEL' => $data['u_tel'] ,
            'U_GRADE' => $data['u_grade'] ,
         );
		 $this->db->where('ID', $id);
         $this->db->update('CENTER_MEMBER', $values);
    }
    function delete_team($guid){
		$this->db->delete('APPLIED_ATHLETE_TEAM', array('ATHLETE_GUID' => $guid));
    }
    function update_team($data){
		$id = $data['id'];
        $values = array(
            'A_NAME' => $data['ath_name'] ,
            'A_JUMIN' => $data['ath_jumin'] ,
            'A_YEAR' => $data['ath_year'] ,
            'ATHLETE_GUID' => $data['a_guid'] ,
         );
         $this->db->where('ID', $id);
		 $this->db->insert('APPLIED_ATHLETE_TEAM', $values);
    }
    function delete_athlete($id){
        $athlete = $this->db->get_where('APPLIED_ATHLETE', array('ID'=>$id))->row();
		if ($athlete->ATHLETE_CNT > 1){
			$this->db->delete('APPLIED_ATHLETE_TEAM', array('ATHLETE_GUID' => $athlete->A_GUID));
		}
		$this->db->delete('APPLIED_ATHLETE', array('ID' => $id));
    }
    function delete_center_member($id){
		$this->db->delete('CENTER_MEMBER', array('ID' => $id));
    }
    function update_athlete($data){
        $id = $data['id'];
        $arr = array(
            'A_NAME' => $data['ath_name'],
            'A_JUMIN' => $data['ath_jumin'],
            'A_YEAR' => $data['ath_year'],
			'A_WEIGHT' => $data['weight_id'],
            'JONGMOK_ID' => $data['jongmok_id'],
            'CATEGORY_ID' => $data['category_id'],
            'ATT_PRICE' => $data['att_price'],
            'ATHLETE_CNT' => $data['athlete_cnt'],
			//'VIDEO_ID' => $data['video_id'], 
			'A_PICTURE' => $data['a_picture'], 
        );
        $this->db->where('ID', $id);
        $this->db->update('APPLIED_ATHLETE', $arr);
    }
	function update_athlete_videoid($data){
        $a_id = $data['a_id'];
		$video_id = $data['video_id'];
		$this->db->where('ID', $a_id);
        $this->db->update('APPLIED_ATHLETE', array("VIDEO_ID"=>$video_id));
    }
    function update_athlete_attprice(){
		$cid = $_SESSION['compet_id'];
		$sid = $_SESSION['center_id'];
        $dc = $_SESSION['discount_price'];
		$kind = $_SESSION['KIND2'];
		$procedure = "execute procedure CALC_DISCOUNT_PRICE(?,?,?)";
		$data = array('C_ID'=>$cid, 'S_ID'=>$sid, 'D_KIND'=>$kind);
		$this->db->query($procedure, $data);
		//$this->db->query('EXEC CALC_DISCOUNT_PRICE $cid $sid $kind $dc');
    }
   	function select_center(){
        $this->db->order_by('CENTER_NAME ASC');
        return $this->db->get('REGISTED_CENTER')->result_array();
    }
	function get_center_by($center_id) {
		$query = $this->db->get_where('REGISTED_CENTER', array('ID'=>$center_id));
		//var_dump($query->result());
        if ($query->result()) {
            $center = array();
            foreach ($query->result() as $item) {
                $center[$item->ID] = array(
                    iconv("EUC-KR", "UTF-8", $item->CENTER_NAME),
                    iconv("EUC-KR", "UTF-8", $item->C_NAME),
                    iconv("EUC-KR", "UTF-8", $item->ADDR1),
                    $item->EMAIL,
                    $item->LOGIN_PASS,
                    $item->TEL,
                    $item->MOBILE,
                );
            }
            return $center;
        } else {
            return FALSE;
        }
    }
    function get_center_id($id){
        return $this->db->get_where('REGISTED_CENTER', array('ID'=>$id))->row();
    }
    function get_center_members($id){
        return $this->db->get_where('CENTER_MEMBER', array('C_GUID'=>$id))->result_array();
    }
    function get_center_guid($id){
        return $this->db->get_where('REGISTED_CENTER', array('C_GUID'=>$id))->row();
    }
	function get_country(){
		return $this->db->get('COUNTRY_CODE')->result_array();
	}
	function get_country_id($id){
		return $this->db->get_where('COUNTRY_CODE', array('ID'=>$id))->result_array();
	}
	function get_country_by_aid($aid){
		return $this->db->get_where('ATHLETE_COUNTRY_VIEW', array('ID'=>$aid))->row();
	}
    function update_center($data){
        $id = $data['id'];
        $arr = array(
            'C_NAME' => $data['c_name'],
            'EMAIL' => $data['email'],
            'C_AREA' => $data['area_name'],
            'TEL' => $data['tel'],
            'APPROVED' => 1,
            'MOBILE' => $data['mobile'],
            'LOGIN_PASS' => $data['login_pass'],
			'RECOMMANDER' => $data['recommander'],
			'RECOMMANDER_TEL' => $data['recommander_tel'],
			'COUNTRY_ID' => $data['country_id'],
        );
        $this->db->where('ID', $id);
        $this->db->update('REGISTED_CENTER', $arr);
    }
    function get_request_doc($compet_id, $school_id){
        return $this->db->get_where('REQUEST_DOCUMENT', array('COMPET_ID'=>$compet_id, 'SCHOOL_ID'=>$school_id))->result_array();  
    }
    function delete_request_doc($id){
        return $this->db->delete('REQUEST_DOCUMENT', array('ID'=>$id));  
    }
    function insert_request_image($data){
		$COMPET_ID = $_SESSION['compet_id'];
		$SCHOOL_ID = $_SESSION['center_id'];
        $data = array(
           'COMPET_ID' => $COMPET_ID,
           'SCHOOL_ID' => $SCHOOL_ID,
           'DOC_NAME' => $data['DOC_NAME'],
           'UNIQ_FILENAME' => $data['UNIQ_FILENAME'],
           'ORG_FILENAME' => $data['ORG_FILENAME'],
           'D_DATE' => date('Y-m-d'),
       );
       $this->db->insert('REQUEST_DOCUMENT', $data);
    }
	//서약서.........
    function get_request_suyaksu($compet_id, $school_id){
        return $this->db->get_where('REQUEST_SUYAKSU', array('COMPET_ID'=>$compet_id, 'SCHOOL_ID'=>$school_id))->result_array();  
    }
    function delete_request_suyaksu($id){
        return $this->db->delete('REQUEST_SUYAKSU', array('ID'=>$id));  
    }
    function insert_request_suyaksu($data){
		$COMPET_ID = $_SESSION['compet_id'];
		$SCHOOL_ID = $_SESSION['center_id'];
        $data = array(
           'COMPET_ID' => $COMPET_ID,
           'SCHOOL_ID' => $SCHOOL_ID,
           'UNIQ_FILENAME' => $data['UNIQ_FILENAME'],
           'ORG_FILENAME' => $data['ORG_FILENAME'],
           'D_DATE' => date('Y-m-d'),
       );
       $this->db->insert('REQUEST_SUYAKSU', $data);
    }
	function get_game_score_list($coat_no){
		$compet_id = $_SESSION['compet_id'];
		$this->db->order_by('ID ASC');
        return $this->db->get_where('GAME_SCORE_REMOTE_IN4', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no))->result_array();
    }
	function get_game_score_list2($coat_no){
		$compet_id = $_SESSION['compet_id'];
		$this->db->order_by('WIN_KIND ASC, POINT_TOTAL DESC');
        return $this->db->get_where('GAME_SCORE_REMOTE_IN4', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no))->result_array();
    }
	function get_game_score_list3($jo){
		$compet_id = $_SESSION['compet_id'];
		$this->db->order_by('WIN_KIND ASC');
        return $this->db->get_where('COMPETITION_WINNER', array('COMPET_ID'=>$compet_id, 'CATEGORY_ID'=>$cat_no, 'JO_NO'=>$jo))->result_array();
    }
	function get_game_score_checked($coat_no){
		$compet_id = $_SESSION['compet_id'];
		$this->db->order_by('ID ASC');
        return $this->db->get_where('GAME_SCORE_REMOTE_IN4', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no, 'IS_CHECKED'=>1))->result_array();
    }
	function get_game_score_team_result($coat_no){
		$compet_id = $_SESSION['compet_id'];
		$this->db->order_by('WIN_KIND ASC, TXT_TOTAL DESC');
        return $this->db->get_where('GAME_SCORE_REMOTE_IN4', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no))->result_array();
    }
	function get_game_score_list_judge(){
		$compet_id = $_SESSION['compet_id'];
		$coat_no = $_SESSION['coat_no'];
		$judge_no = $_SESSION['judge_no'];
		$this->db->order_by('ID ASC');
        return $this->db->get_where('GAME_SCORE_REMOTE_IN4', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no, 'A_ORDERNO'=>$judge_no))->result_array();
    }
	function get_game_score_list_id($id){
		$this->db->order_by('WIN_KIND ASC');
        return $this->db->get_where('GAME_SCORE_REMOTE_IN4', array('ID'=>$id))->row();
    }
    function get_match_id(){
		$compet_id = $_SESSION['compet_id'];
		$coat_no = $_SESSION['coat_no'];
        return $this->db->get_where('GAME_SCORE_REMOTE_IN4', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no))->row();
    }
	function get_match_list($category_id){
		$this->db->order_by('ID ASC');
        return $this->db->get_where('GAME_SCORE_LIST', array('CATEGORY_ID'=>$category_id))->result_array();
    }
	function get_score_mix_view($category_id){
		$compet_id = $_SESSION['compet_id'];
		$this->db->order_by('GAME_SET ASC, GAME_ID ASC, ID ASC');
        //return $this->db->get_where('GAMESCORE_ATHLETE_CENTER_MIX', array('COMPET_ID'=>$compet_id, 'CATEGORY_ID'=>$category_id))->result_array();
		return $this->db->get_where('GAME_SCORE_MIX_VIEW', array('CATEGORY_ID'=>$category_id))->result_array();
		
    }
	function find_athlete_name($a_name){
		$compet_id = $_SESSION['compet_id'];
		$this->db->like('MIX_NAME', $a_name, 'both');
		//$this->db->like('CENTER_NAME', $a_name, 'both');
        return $this->db->get_where('ATHLETE_MIX_VIEW', array('COMPET_ID'=>$compet_id))->result_array();
    }
	function find_center_name($a_name){
		$compet_id = $_SESSION['compet_id'];
		//$this->db->like('A_NAME', $a_name, 'both');
		$this->db->like('CENTER_NAME', $a_name, 'both');
        return $this->db->get_where('ATHLETE_MIX_VIEW', array('COMPET_ID'=>$compet_id))->result_array();
    }
	function get_game_list_by_coat($cat_id){
		$compet_id = $_SESSION['compet_id'];
		$this->db->order_by('GAME_SET ASC, GAME_ID ASC, ID ASC');
		return $this->db->get_where('GAME_SCORE_MIX_VIEW', array('COMPET_ID'=>$compet_id, 'CATEGORY_ID'=>$cat_id))->result_array();
	}
	////////////////////////////
	// 비디오재생관련...
	////////////////////////////
	function update_judge_response($data){
		$values = array('RESPONSE_DATA' => 1);
		$array = array('COMPET_ID' => $data['compet_id'], 'J_COAT' => $data['coat_no'], 'J_NO' => $data['judge_no']);
        $this->db->where($array);
        $this->db->update('JUDGE_ASSIGN', $values);
	}
	function get_judge_assign_game($match_id){
        return $this->db->get_where('JUDGE_ASSIGN_GAME_VIEW', array('MATCH_ID'=>$match_id))->row();
	}
	function get_judge_assign(){
		$compet_id = $_SESSION['compet_id'];
		$coat_no = $_SESSION['coat_no'];
		$this->db->order_by('J_NO ASC');
        return $this->db->get_where('JUDGE_ASSIGN_VIEW', array('COMPET_ID'=>$compet_id, 'J_COAT'=>$coat_no))->result_array();
	}
	function get_jongmok_info(){
		$compet_id = $_SESSION['compet_id'];
		$coat_no = $_SESSION['coat_no'];
        return $this->db->get_where('VIDEO_PLAYER_JONGMOK', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no))->row();
	}
	//** 새방식  유뷰브비디오와 선수별 점수자료 추출... 
	function get_video_player_data(){
		$compet_id = $_SESSION['compet_id'];
		$coat_no = $_SESSION['coat_no'];
		$this->db->order_by('ID ASC');
        return $this->db->get_where('VIDEO_PLAYER', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no))->result_array();
    }
	function get_video_action($coat_no){
		$compet_id = $_SESSION['compet_id'];
        return $this->db->get_where('VIDEO_PLAYER_ACTION', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no))->row();
	}
	function get_point_action($coat_no){
		$compet_id = $_SESSION['compet_id'];
        return $this->db->get_where('POINT_ACTION', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no))->row();
	}
	//동영상재생품질선택...
	function get_videoplayer_quality(){
		return $this->db->get_where('SETTING', array('ID'=>6))->row();
	}
	//유뷰브비디오와 선수별 점수자료 추출...
	function get_point_display_all($coat_no){
		$compet_id = $_SESSION['compet_id'];
		$this->db->order_by('GAME_NO ASC');
        return $this->db->get_where('COMPET_POINT_DISPLAY', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat_no))->result_array();
    }
	//선수의 유튜브 동영상ID 추출...
	function get_athlete_video($a_id){
		return $this->db->get_where('APPLIED_ATHLETE', array('ID'=>$a_id))->row();
	}
	function update_video_action($coat_no){
		$compet_id = $_SESSION['compet_id'];
		$values = array('C_ACTION' => 2);
        $this->db->where('COMPET_ID', $compet_id);
        $this->db->where('COAT_NO', $coat_no);
        $this->db->update('VIDEO_PLAYER_ACTION', $values);
	}
	function update_score($data){
		//$judge = $data['judge_no'];
		$judge = $_SESSION['judge_no'];
		$values = array('J'.$judge.'_POINT' => round($data['point'],2),);
		$id = $data['id'];
        $this->db->where('ID', $id);
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
	}
	function update_score_cutoff($data){
		//$judge = $data['judge_no'];
		$judge = $_SESSION['judge_no'];
		$values = array('J'.$judge.'_POINT2' => round($data['point1'],2),	'J'.$judge.'_POINT3' => round($data['point2'],2),);
		$id = $data['id'];
        $this->db->where('ID', $id);
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
	}
	function update_score_cutoff1($data){
		//$judge = $data['judge_no'];
		$judge = $_SESSION['judge_no'];
		$values = array('J'.$judge.'_POINT' => round($data['point1'],2));
		$id = $data['id'];
        $this->db->where('ID', $id);
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
	}
	function update_score_torn($data){
		//$judge = $data['judge_no'];
		$judge = $_SESSION['judge_no'];
		$values = array('J'.$judge.'_POINT2' => round($data['bpoint1'],2),	'J'.$judge.'_POINT3' => round($data['bpoint2'],2),);
		$id = $data['bid'];
        $this->db->where('ID', $id);
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
		
		$values = array('J'.$judge.'_POINT2' => round($data['rpoint1'],2),	'J'.$judge.'_POINT3' => round($data['rpoint2'],2),);
		$id = $data['rid'];
        $this->db->where('ID', $id);
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
	}
	function update_score_break($data){
		$values = array('J1_POINT' => round($data['point'],2),);
		$id = $data['id'];
        $this->db->where('MATCH_ID', $id);
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
	}
	function update_score_jump1($data){
		$judge = $data['judge_no'];
		$values = array('J1_POINT' => round($data['point'],2),);
		$id = $data['id'];
        $this->db->where('MATCH_ID', $id);
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
	}
	function update_score_jump2($data){
		$judge = $data['judge_no'];
		$values = array('J2_POINT' => round($data['point'],2),);
		$id = $data['id'];
        $this->db->where('ID', $id);
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
	}
	function update_score_fight($data){
		$COMPET_ID = $_SESSION['compet_id'];
		$judge_no = $game_info['judge_no'];
		$POINT = $game_info['point'];
		$values = array('J1_POINT' => round($data['point'],2),);
		$id = $data['id'];
        $this->db->where('ID', $id);
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
	}
	function insert_game_score_time($game_info){
		$COMPET_ID = $_SESSION['compet_id'];
		$judge_no = $_SESSION['judge_no'];
		$match_id = $_SESSION['match_id'];
		$POINT = $game_info['point'];
        $data = array(
           'COMPET_ID' => $COMPET_ID,
           'MATCH_ID' => $match_id,
           'JUDGE_ID' => $judge_no,
           'ACT_TIME' => strtotime("now"),
           'J_POINT' => $POINT,
       );
       $this->db->insert('GAME_SCORE_TIME_POINT', $data);
    }	
	function update_point_done(){
		$compet_id = $_SESSION['compet_id'];
		$judge = $_SESSION['judge_no'];
		$coat = $_SESSION['coat_no'];
		if($judge == 1){$values = array('J1_DONE' => 1);}
		if($judge == 2){$values = array('J2_DONE' => 1);}
		if($judge == 3){$values = array('J3_DONE' => 1);}
		if($judge == 4){$values = array('J4_DONE' => 1);}
		if($judge == 5){$values = array('J5_DONE' => 1);}
        $this->db->where('COMPET_ID',$compet_id);
        $this->db->where('COAT_NO',$coat); 
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
	}
    function api_get_athletes($coat_no){
        $query = $this->db->get_where('GAME_SCORE_REMOTE_IN4', array('COAT_NO'=>$coat_no));
		$compet = array();
		//여러 값을 넘길 때는 array로 필요한 데이트를 추가한다.
		foreach ($query->result() as $list) {
			$item = array();
			$item[0] = $list->MATCH_ID;
			$item[1] = $list->JONGMOK_NAME;
			$item[2] = $list->BLUE_NAME;
			$item[3] = $list->RED_NAME;
			$compet[] = $item;
		}
		return $compet;
	}
	function api_update_score($data){
		$match_id = $data['match_id'];
		$judge = $data['judge'];
		$blue_red = $data['a_kind'];
		if ($blue_red == "1"){
			$values = array('B_J'.$judge => round($data['point'],2),);
		}else{
			$values = array('R_J'.$judge => round($data['point'],2),);
		}
        $this->db->where('MATCH_ID', $match_id);
        $this->db->update('GAME_SCORE_REMOTE_IN4', $values);
	}
    function api_get_competitions(){
		$this->db->order_by('ID', 'DESC');
		$query = $this->db->get('COMPETITIONS');
		$compet = '';
		//여러 값을 넘길 때는 array로 필요한 데이트를 추가한다.
		foreach ($query->result_array() as $item) {
			$compet = $compet . $item['ID'].','. 
					iconv("CP949", "UTF-8", $item['C_NAME']).','.
					iconv("CP949", "UTF-8", $item['C_PLACE']).'<br>';
		}
		return $compet;
	}
	function api_insert_data($data){
		$values = array(
            'C_NAME' => iconv("UTF-8","CP949", $data['c_name']) ,
            'C_ADD' => iconv("UTF-8","CP949", $data['c_add']) ,
         );
         $this->db->insert('TEST_TABLE', $values);
    }
    /////////////////////////////////
    // 게임진행상태 표출
    /////////////////////////////////
    function get_game_list($coat){
		$compet_id = $_SESSION['compet_id'];
		$this->db->order_by('GAME_SET, GAME_ID');
        return $this->db->get_where('GAME_SCORE_LIST_PROCESS', array('COMPET_ID'=>$compet_id, 'COAT_NO'=>$coat))->result_array();
    }
    /////////////////////////////////
    // 유튜브 플레이더 상태업데이트
    /////////////////////////////////
	function update_player_status($done){
		$values = array('DONE_CNT' => $done);
        $this->db->where('COMPET_ID', $_SESSION['compet_id']);
        $this->db->where('COURT_NO', $_SESSION['coat_no']);
        $this->db->update('YOUTUBE_PLAYER_STATUS', $values);
	}
	function get_video_list($data_id){
		return $this->db->get_where('VIDEO_IMAGE_STATUS', array('DATA_ID'=>intval($data_id)))->row();
	}
	function update_video_status(){
		$values = array('PLAY_STATUS' => 1);
        $this->db->where('DATA_ID', $_SESSION['data_id']);
        $this->db->update('VIDEO_IMAGE_STATUS', $values);
	}
	
}
