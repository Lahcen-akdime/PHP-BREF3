async function fetchIt(name){
    let response = await fetch("http://localhost/APEX/jsonData/allMembers.php?query="+name)
    let data = await response.json()
    return data;
}