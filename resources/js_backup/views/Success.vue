<template>
    <div class="wrapper">
        <div class="main-container">
            <img class="client-logo" src="/assets/images/client-logo.svg" />

            <div id="content-1" class="content">
                <div class="row">
                    <h3>
                        Your registration form has been submitted and a
                        confirmation receipt has been sent to your E-mail.
                    </h3>
                </div>

                <div class="row">
                    <img
                        class="confirm-image"
                        src="/assets/images/confimation-client-image.svg"
                    />
                </div>

                <div class="row wait-activation-text">
                    <h3>Kindly wait and check for your activation status.</h3>
                </div>
            </div>
        </div>

        <div class="login-footer">
            <h3>HRIS Application is Powered by Array 2022</h3>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
.wrapper {
    width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.main-container {
    width: 660px;
    height: 740px;
    display: flex;
    flex-direction: column;
    padding: 80px 70px;
    background-color: #efefef;
    box-shadow: 2px 2px 5px 2px #cccccc;
    border-radius: 5px;
    margin-top: 385;
}

.content {
    display: flex;
    flex-direction: column;
}

.client-logo {
    height: auto;
    width: 300px;
    margin-top: -30px;
    margin-bottom: 20px;
    align-self: center;
}

.row-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 5px;
}

.row {
    display: flex;
    align-items: center;
    justify-content: center;
}

.row h3 {
    text-align: center;
    font-size: 1.2em;
    color: #6f499b;
}

.confirm-image {
    height: 320px;
    margin-top: 20px;
}

.wait-activation-text {
    margin-top: 45px;
    height: 50px;
    border: solid 3px #008ebb;
    padding-bottom: 1px;
}

.wait-activation-text h3 {
    color: #008ebb;
    font-size: 1.1em;
    font-weight: 700;
}

.field-col {
    width: 100%;
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
}

.text-field {
    width: 70%;
    height: 34px;
    border: solid 1px #a9a9a9;
    border-radius: 5px;
    padding-left: 10px;
    outline: none;
}

.text-field:focus {
    border: solid 2px #6f499b;
}

.company-code-row {
    display: flex;
    flex-direction: row;
    width: 70%;
}

.company-code-field {
    width: 80%;
    height: 34px;
    border: solid 1px #a9a9a9;
    border-radius: 5px 0px 0px 5px;
    padding-left: 10px;
    outline: none;
}

.company-code-button {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #92c156;
    border-radius: 0 5px 5px 0;

    font-family: "Noto Sans", sans-serif;
    color: white;

    cursor: pointer;

    width: 20%;
    height: 34px;
}

.company-code-button:hover {
    opacity: 0.85;
}

#sign-up {
    height: 40px;
    color: white;
    background-color: #6f499b;
    border: none;
    border-radius: 5px;

    font-family: "Source Sans Pro", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    letter-spacing: 0.3px;
    margin-top: 40px;
}

#sign-up:hover {
    opacity: 0.85;
    cursor: pointer;
}

#change-password {
    height: 40px;
    color: white;
    background-color: #92c156;
    border: none;
    border-radius: 5px;

    font-family: "Source Sans Pro", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    letter-spacing: 0.3px;

    margin-top: 50px;
    margin-bottom: 10px;
}

#change-password:hover {
    opacity: 0.85;
    cursor: pointer;
}

h3 {
    padding: 10px 0;
    margin: 0;
    font-family: "Noto Sans", sans-serif;
    font-weight: 600;
    font-size: 1.1em;
    color: #008dba;
}

#forgot-pass:hover {
    text-decoration: none;
    color: #92c156;
}

#content-3 {
    display: flex;
    align-items: center;
    align-content: center;
}
#loader {
    width: 150px;
    padding-top: 80px;
}

#content-3 p {
    font-family: "Source Sans Pro", sans-serif;
    font-weight: 600;
    font-size: 1.6em;
    letter-spacing: 0.3px;
    color: #6f499b;
    padding-top: 20px;
}

.login-footer {
    height: 40px;
    width: 660px;
    margin-top: 25px;
    background-color: #52a2a6;
    border-radius: 5px;
    box-shadow: 2px 2px 5px 2px #cccccc;
    cursor: pointer;
}

.login-footer h3 {
    font-weight: 500;
    font-size: 1em;
    text-align: center;
    color: white;
}
</style>
