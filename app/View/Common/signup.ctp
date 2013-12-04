<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery("#validate_form").validationEngine();
});
</script>

<div class="container" style="background-color:#e0ffff">
  <div class="row">
    <div class="span8">
	  <form id="validate_form" class="formular" method="get">
        <fieldset>
          <legend>【プロフィール登録】</legend>
          <p>
              ◎ニックネーム：<br>
              <?php echo $this->BootstrapForm->text("user.nickname",
              $options=array( "class" => "validate[required, minSize[2], maxSize[10]] text-input search-query", "id" => "nickname"));
              ?>(必須)<br>
          </p>
          <p>
          <input type="checkbox" id="chckbox_enabled" value="" checked>表示する
          </p>
          <div id="enabled">
          <p>
              ◎趣味を選択：<br>
              <div id="hobbys_clone">
                <p class="hobby_prefab" id="hobby_prefab0">
                <select name="user.hobbys[0]" class="userHobbys" id="userHobbys0">
                  <?php
                  foreach($hobbys as $val => $key) { 
                      echo "<option value={$val}>{$key}</option>";
                  }
                  ?>
                </select>
                </p>
              </div>
          </p>
          <button class="btn" type="button" id="add">追加</button><br>
          ◎目的を選択：<br>
          <p>
                <?php echo $this->BootstrapForm->input( 'user.purposes', array( 
                    'type' => 'select', 
                    'multiple'=> 'checkbox',
                    'options' => $purposes, 
                //  'selected' => $selected  // 規定値は、valueを配列にしたもの
                ));
              ?>
          </p>
          <p>
              ◎自由入力欄：<br>
             <?php echo $this->BootstrapForm->textarea("user.description", array("cols"=>20, "rows"=>5, "value"=>"")); ?><br>
          </p>
          </div>
        </fieldset>
        <button class="btn" type="button" id="open">OK</button>
	  </form>
    </div>
  </div>
</div>
<?php echo $this->BootstrapForm->hidden('add_hobby_num', array('value'=>'0')); ?>

<!--ダイアログエリア-->
<div id="dialog" title="登録確認" style="background-color:#e0ffff">
    <fieldset>
    <legend>【プロフィール登録】</legend>
    <p>
        ◎ニックネーム：<div id ="confirm_nickname"></div>
    </p>
    <p>
        ◎趣味：<div id ="confirm_hobby"></div>
    </p>
    </fieldset>
    <button class="btn" type="button" id="regist">登録する</button>
    <div class="container" id="loading"/></div>
</div>
<!--ダイアログエリア-->



<script type="text/javascript">
$(function() {
    $.fn.to_array = function(options) {
        var defaults = {
            type : 'key'
        };
        var setting = $.extend(defaults, options);
        var result = [];
        $(this).each(function(key, val){
            if(setting.type == 'string'){
              result.push(val[key].text);
            } else if(setting.type == 'key') {
              result.push(val[key].value);
            }
        });
        return result;
    }
    
    $('#chckbox_enabled').on("change", function () {
        if ($('#chckbox_enabled').prop('checked')) {
            $("#enabled").show("slow");
        } else {
            $("#enabled").hide("slow");
        }
    });
    
    
    $('.userHobbys').on("change", function () {
        var parent_name= this.name;
        var parent_id= this.id;
        $('#loading').html("<img src='/facebook/img/gif-load.gif'/>");
        $.ajax({
            url: '/facebook/api/get_children_hobbys',
            type: "POST",
            dataType: "json",
            data: {
                "prarent_id": this.value,
            },
            success : function(data) {
                $("#loading").empty();
                // 子オブジェクトがいない時append処理を行う
                if($("*[name='" + parent_name + "[0]']").val()) {
                    return false;
                }
                if (data.result_type == 1) {
                    var element = $("#userChildHobbys")
                        .clone(true)
                        .removeAttr("id");
                    
                    var string = "";
                    for(var key in data.children_hobbys){
                        string += "<option value="+ key + ">" + data.children_hobbys[key]+ "</option>";
                    }
                    $("#" + parent_id)
                        .parent("#hobby_prefab" + $("#add_hobby_num").val())
                        .append("<select name=" + parent_name + "[0] class='userHobbys'>" + string + "</select>")
                }
            }
        });
        return false;
    });
    

    $('#add').on("click", function () {
   
        var element = $("#hobby_prefab" + $("#add_hobby_num").val())
            .clone(true);

        $("#hobbys_clone").append(element);
        
        $("#add_hobby_num").val(parseInt($("#add_hobby_num").val()) + 1); 
        
        $("#hobbys_clone")
            .children(".hobby_prefab:last")
            .attr("id", "hobby_prefab" + $("#add_hobby_num").val())
            .children(".userHobbys:last")
            .attr("id", "userHobbys" + $("#add_hobby_num").val())
            .attr("name", "userHobbys[" + $("#add_hobby_num").val() +"]" );
            //.parent("#hobby_prefab" + $("#add_hobby_num").val());
        
               
        return false; 
    });

    $('#open').on("click", function () {
        $("#confirm_nickname").html($("#nickname").val());
        $("#confirm_hobby").html($("*[name='user.hobbys[]']").to_array({type:'string'}));
    });
    
    $('#regist').on("click", function () {
        var hobby_selects = $("*[name='user.hobbys[]']").to_array();
        $('#loading').html("<img src='/facebook/img/gif-load.gif'/>");
        $.ajax({
            url: '/facebook/api/regist_user',
            type: "POST",
            dataType: "json",
            data: {
                "nickname": $("#nickname").val(),
                "user_hobby[]": $("*[name='user.hobbys[]']").to_array()
            },
            success : function(data) {
                $("#loading").empty();
                if (data.result_type == 1) {
                }
                else {
                  $("#dialog").dialog("close");
                  $.each(data.error, function(i, val) {
                  });
                }  
            },
            error : function(data) {
                $("#loading").empty();
            }
        });
    });  
});
</script>
