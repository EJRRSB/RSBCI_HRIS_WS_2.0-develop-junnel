import { reactive } from "vue"

export const getTenantName = () => {

    if (window.location.host.split('.')[0] == "www") {
        return window.location.host.split('.')[1]
    }
    return window.location.host.split('.')[0]
}

export const config = reactive({
    headersFileUpload: {
        'Accept': 'application/json',
        "Content-type": "multipart/form-data",
        'SubDomainName': 'SubDomain ' + getTenantName(),
        'Authorization': localStorage.getItem('token'),

    },
    headersLogin: {
        'Accept': 'application/json',
        'SubDomainName': 'SubDomain ' + getTenantName(),

    },
    headers: {
        'Accept': 'application/json',
        'SubDomainName': 'SubDomain ' + getTenantName(),
        'Authorization': localStorage.getItem('token'),
    },
    apiURL: 'http://127.0.0.1:8080/api/v1/',
    // apiURL: '/api/v1/', 
    // https://api.rsbcidevteam.tech/test_domain/api/v1/
    // http://127.0.0.1:8000/api/v1/
})