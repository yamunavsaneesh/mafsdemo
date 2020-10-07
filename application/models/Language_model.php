<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Language_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'languages';
    }
    public function get_array()
    {
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }
    public function get_active()
    {
        $this->db->where('status', 'Y');
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }
    public function get_active_array()
    {
        $langs = array();
        $this->db->where('status', 'Y');
        $query = $this->db->get($this->table_name);
        foreach ($query->result_array() as $row):
            $langs[$row['code']] = $row['name'];
        endforeach;
        return $langs;
    }
    public function get_array_limit($limit)
    {
        $this->db->limit($limit);
        $query = $this->db->get($this->table_name);
        return $query->result_array();
    }
    public function load($id)
    {
        $id = $this->db->escape_str($id);
        $cond = array('id' => $id);
        $this->db->where($cond);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }
    public function get_row_cond($cond)
    {
        $this->db->where($cond);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }
    public function insert($data)
    {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }
    public function update($data, $cond)
    {
        return $this->db->update($this->table_name, $data, $cond);
    }
    public function delete($cond)
    {
        return $this->db->delete($this->table_name, $cond);
    }
    public function get_pagination_count($cond = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }
        $this->db->from($this->table_name);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_pagination($num, $offset, $cond = '')
    {
        $this->db->select('*');
        if (is_array($cond) && count($cond) > 0) {
            $this->db->where($cond);
        }
        $this->db->from($this->table_name);
        $this->db->limit($num, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function code_exists($code, $id)
    {
        $this->db->where('code', $code);
        $this->db->where('id !=', $id);
        $query = $this->db->get($this->table_name);
        $result = $query->num_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function updatedesc($code)
    {
        $this->db->query("insert into `contact_category_desc` (contact_category_id,name,language) select contact_category_id,name,'$code' from `contact_category_desc` where language='en'");
        $this->db->query("INSERT INTO `banners_desc` (`banners_id`, `title`, `short_desc`, `icon`, `image`, `language`) select `banners_id`, `title`, `short_desc`, `icon`, `image`,'$code' from `banners_desc` where language='en'");
        $this->db->query("INSERT INTO `contacts_desc` (`contacts_id`, `address`, `language`) select `contacts_id`, `address`,'$code' from `contacts_desc` where language='en'");
        $this->db->query("INSERT INTO `contents_desc` (`contents_id`, `title`, `short_desc`, `desc`, `keywords`, `banner_text`, `banner_image`, `language`) select `contents_id`, `title`, `short_desc`, `desc`, `keywords`, `banner_text`, `banner_image`,'$code' from `contents_desc` where language='en'");
        $this->db->query("INSERT INTO `content_category_desc` (`content_category_id`, `name`, `short_desc`, `keywords`, `language`) select `content_category_id`, `name`, `short_desc`, `keywords`,'$code' from `content_category_desc` where language='en'");
        $this->db->query("INSERT INTO `localization` (`lang_key`, `lang_value`, `language`) select `lang_key`, `lang_value`,'$code' from `localization` where language='en'");
        $this->db->query("INSERT INTO `menuitems_desc` (`menuitems_id`, `class`, `name`, `link`, `language`) select `menuitems_id`, `class`, `name`, `link`,'$code' from `menuitems_desc` where language='en'");
        $this->db->query("INSERT INTO `pages_desc` (`pages_id`, `title`, `short_desc`, `desc`, `keywords`, `banner_text`, `banner_image`, `language`) select `pages_id`, `title`, `short_desc`, `desc`, `keywords`, `banner_text`, `banner_image`,'$code' from `pages_desc` where language='en'");
        $this->db->query("INSERT INTO `settings_desc` (`settings_id`, `settingvalue`, `language`) select `settings_id`, `settingvalue`,'$code' from `settings_desc` where language='en'");
    }
    public function deletedesc($code)
    {
        $this->db->query("DELETE FROM `contact_category_desc` where language='" . $code . "'");
        $this->db->query("DELETE FROM `banners_desc` where language='" . $code . "'");
        $this->db->query("DELETE FROM `contacts_desc` where language='" . $code . "'");
        $this->db->query("DELETE FROM `contents_desc` where language='" . $code . "'");
        $this->db->query("DELETE FROM `content_category_desc` where language='" . $code . "'");
        $this->db->query("DELETE FROM `downloads_desc` where language='" . $code . "'");
        $this->db->query("DELETE FROM `faqs_desc` where language='" . $code . "'");
        $this->db->query("DELETE FROM `faq_category_desc`  where language='" . $code . "'");
        $this->db->query("DELETE FROM `countries` where language='" . $code . "'");
        $this->db->query("DELETE FROM `localization`  where language='" . $code . "'");
        $this->db->query("DELETE FROM `menuitems_desc` where language='" . $code . "'");
        $this->db->query("DELETE FROM `pages_desc` where language='" . $code . "'");
        $this->db->query("DELETE FROM `settings_desc` where language='" . $code . "'");
        $this->db->query("DELETE FROM `widgets_desc` where language='" . $code . "'");
    }
    public function language_pair()
    {
        $idpair = array();
        $this->db->from($this->table_name);
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        foreach ($query->result_array() as $row):
            $idpair[$row['code']] = $row['name'];
        endforeach;
        return $idpair;
    }
    public function language_conversion()
    {
        $idpair = array();
        $this->db->from($this->table_name);
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        foreach ($query->result_array() as $row):
            $idpair[strtolower($row['name'])] = $row['code'];
        endforeach;
        return $idpair;
    }

}
