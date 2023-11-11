function booking(){
    

    let arrival =arr.value;
    let departure=dep.value;


    let book={
        arrival,departure}
    console.log(book)

if(arrival==""){
    error.innerHTML = "Please enter valid date"

}
else {
    localStorage.setItem(book.bookData, JSON.stringify(book))
    alert("Booking Request was successfulll. Resort staff will contact you later")
    location.href = "./index.html"
    console.log(...data)
}
}

