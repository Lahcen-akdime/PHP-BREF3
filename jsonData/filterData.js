async function filterIt(equipeName) {
    let response = await fetch("http://localhost/APEX/jsonData/allMembers.php?equipeName="+equipeName)
    let data = await response.json()
    return data;
}