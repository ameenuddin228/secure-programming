const stripe = Stripe("pk_test_51NNRICBzKMqW3E4yk368HvRTcy1Siu4t4xgQ0MXzdGdHRSKNmnai0dVhUm4dKo3uBNPuupzhOVqQSPSwaWgIRuW400LgUE2mDm")
const btn = document.querySelector('#btn')
btn.addEventListener('click', ()=>{
    fetch('/checkout.php', {
        method: "POST",
        headers:{
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    }).then(res => res.json())
    .then(payload =>{
        stripe.redirectToCheckout({sessionId:payload.id})
    })
    
})