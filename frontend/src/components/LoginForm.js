function LoginForm() {
    return (
        <div className="form-signin text-center mb-10 w-75 ms-3 me-3">
            <i className="fas fa-comment-alt fa-3x text-muted mb-3"></i>
            <h1 className="h3 mb-3 fw-normal">Sign In</h1>
            <div className="card p-5 bg-light">
                <form>
                    <div className="form-floating mb-2">
                        <input type="email" className="form-control" id="floatingInput" placeholder="name@example.com"/>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div className="form-floating mb-2">
                        <input type="password" className="form-control" id="floatingPassword" placeholder="Password"/>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button className="w-100 btn btn-lg btn-purple" type="submit">Sign in</button>
                </form>
            </div>
        </div>
    );
}

export default LoginForm;