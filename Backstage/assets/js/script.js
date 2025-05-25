// script.js
function openPopup(membershipNumber) {
    // 獲取會員資料，這裡假設有一個 membersData 物件包含資料
    var memberData = membersData[membershipNumber];
  
    // 更新彈出視窗中的內容
    document.getElementById("membership_number").value = memberData.membership_number;
    document.getElementById("email").value = memberData.email;
    document.getElementById("password").value = memberData.password;
  
    // 其他欄位的更新，根據需要自行添加
  
    // 顯示彈出視窗
    document.getElementById("popup").style.display = "block";
  }
  
  function closePopup() {
    // 關閉彈出視窗
    document.getElementById("popup").style.display = "none";
  }
  
  function updateMember() {
    // 取得使用者輸入的資料，執行更新操作
    var membershipNumber = document.getElementById("membership_number").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
  
    // 執行資料更新操作，例如使用 AJAX 將資料送回伺服器
  
    // 更新完成後關閉彈出視窗
    closePopup();
  }
  