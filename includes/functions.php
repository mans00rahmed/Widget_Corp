<?php
require_once("includes/connection.php");

// This file will store all basic functions.
function redirect_to($location = NULL){
    if ($location != NULL){
        header("Location : new_subject.php");
        exit;
    }
}
function confirm_query($result_set)
{
    global $conn;
    if (!$result_set) {
        die("Connection Failed : " . $conn->connect_error);
    }
}

function get_all_subjects($public=true){
    global $conn;
    $sql = "SELECT * FROM subjects ";
    if($public) {
        $sql .= "WHERE visible = 1 ";
        }
    $sql .= "ORDER BY position ASC";
    $subject_set = $conn->query($sql);
    confirm_query($subject_set);
    return $subject_set;
}

function get_pages_for_subject($subject_id)
{
    global $conn;
    $sql1 = "SELECT * 
    FROM pages 
    WHERE subject_id = {$subject_id} 
    ORDER BY position ASC";
    $page_set = $conn->query($sql1);
    confirm_query($page_set);
    return $page_set;
}

function get_subject_by_id($subject_id)
{
    global $conn;
    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id=" . $subject_id . " ";
    $query .= "LIMIT 1";
    $result_set = $conn->query($query);
    confirm_query($result_set);
    // if no rows are returned fetch array will return NULL;
    if ($subject = mysqli_fetch_array($result_set)) {
        return $subject;
    } else {
        return NULL;
    }
}

function get_page_by_id($page_id)
{
    global $conn;
    $query = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE id=" . $page_id . " ";
    $query .= "LIMIT 1";
    $result_set = $conn->query($query);
    confirm_query($result_set);
    // if no rows are returned fetch array will return NULL;
    if ($page = mysqli_fetch_array($result_set)) {
        return $page;
    } else {
        return NULL;
    }
}

function find_selected_page()
{
    global $sel_subject;
    global $sel_page;

    if (isset($_GET['subj'])) {
        $sel_subject = get_subject_by_id($_GET['subj']);
        $sel_page = NULL;
    } elseif (isset($_GET['page'])) {
        $sel_subject = NULL;
        $sel_page = get_page_by_id($_GET['page']);
    } else {
        $sel_subject = NULL;
        $sel_page = NULL;
    }
}

function navigation($sel_subject, $sel_page)
{
    $output = "<ul class=\"subjects\">";

    //3 perforom database query
    $subject_set = get_all_subjects();

    //4 output data of each row
    while ($subject = $subject_set->fetch_assoc()) {
        $output .= "<li";
        if ($subject["id"] == $sel_subject['id']) {
            $output .= " class=\"selected\"";
        }
        $output .=  "><a href=\"edit_subject.php?subj=" . urlencode($subject["id"])
            . "\">{$subject["menu_name"]} </a><li/>";

        //3 perforom database query
        $page_set = get_pages_for_subject($subject["id"]);
        $output .=  "<ul class=\"pages\">";
        //4 output data of each row
        while ($page = $page_set->fetch_assoc()) {
            $output .=  "<li";
            if ($page["id"] == $sel_page) {
                $output .= " class=\"selected\"";
            }
            $output .=  "> <a href=\"content.php?page=" . urlencode($page["id"]) . "\">{$page["menu_name"]} </a><li/>";
        }
        $output .=  "</ul>";
    }

    $output .=  "</ul>";
    return $output;
}

function public_navigation($sel_subject, $sel_page, $public = false) {
    $output = "<ul class=\"subjects\">";
    $subject_set = get_all_subjects($public);
    while ($subject = mysqli_fetch_array($subject_set)) {
        $output .= "<li";
        if ($subject["id"] == $sel_subject['id']) { $output .= " class=\"selected\""; }
        $output .= "><a href=\"index.php?subj=" . urlencode($subject["id"]) . 
            "\">{$subject["menu_name"]}</a></li>";
        if ($subject["id"] == $sel_subject['id']) {	
            $page_set = get_pages_for_subject($subject["id"], $public);
            $output .= "<ul class=\"pages\">";
            while ($page = mysqli_fetch_array($page_set)) {
                $output .= "<li";
                if ($page["id"] == $sel_page['id']) { $output .= " class=\"selected\""; }
                $output .= "><a href=\"index.php?page=" . urlencode($page["id"]) .
                    "\">{$page["menu_name"]}</a></li>";
            }
            $output .= "</ul>";
        }
    }
    $output .= "</ul>";
    return $output;
}
?>