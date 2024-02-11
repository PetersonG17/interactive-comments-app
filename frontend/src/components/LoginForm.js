import { environment } from "../environment"
import axios from "axios";

function LoginForm() {

    async function handleClick(e) {
        e.preventDefault();
        console.log(environment)
        // const response = await axios.get("https://dog.ceo/api/breeds/list/all")
        // console.log(response.data)
    }

    return (
        <div className="form-signin text-center mb-10 w-50 ms-3 me-3">
            <i className="fas fa-comment-alt fa-3x text-light-purple mb-3"></i>
            <h1 className="h3 mb-3 fw-normal">Sign In</h1>
            <div className="card p-5 bg-soft">
                <form>
                    <div className="form-floating mb-2">
                        <input type="email" className="form-control" id="floatingInput" placeholder="name@example.com"/>
                        <label htmlFor="floatingInput">Email address</label>
                    </div>
                    <div className="form-floating mb-2">
                        <input type="password" className="form-control" id="floatingPassword" placeholder="Password"/>
                        <label htmlFor="floatingPassword">Password</label>
                    </div>
                    <button className="w-100 btn btn-lg btn-purple" onClick={handleClick}>Sign in</button>
                </form>
            </div>
        </div>
    );
}

export default LoginForm;