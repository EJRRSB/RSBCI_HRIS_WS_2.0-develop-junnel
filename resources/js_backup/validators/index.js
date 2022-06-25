export default function useValidators() {

    /**
     * Returns true if value param is null or white spare.
     *
     * @param {string} value The value to validate.
     * @return {boolean} check if value is Null or Whitespaces only.
     */
    const v_required = (value) => {
        if (value === null || !/\S/.test(value)) {
            return true;
        }
        return false;
    }

    /**
     * Returns true if value is not on email format.
     *
     * @param {string} value The value to validate.
     * @return {boolean} check if value is not on email format.
     */
    const v_email = (value) => {
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(
                value
            )) {
            return true;
        }
        return false;
    }

    /**
     * Returns true if value contains white space.
     *
     * @param {string} value The value to validate.
     * @return {boolean} check if value if has white space.
     */
    const v_username = (value) => {
        if (value.indexOf(' ') >= 0) {
            return true;
        }
        return false;
    }

    /**
     * Returns true if value didn't met password requirements.
     *
     * @param {string} value The value to validate.
     * @return {boolean} check if value if has white space.
     */
    const v_password = (value) => {
        if (value.indexOf(' ') >= 0) {
            return true;
        }
        return false;
    }





    return { v_required, v_email, v_username }
}
