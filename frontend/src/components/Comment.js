import profile_pic from "../image-amyrobson.png";
import styles from './Comment.module.css';

function Comment() {
    return (
        <div className={styles['comment-box']}>

            {/* Votes */}
            <div className={styles['votes-box']}>
                <div>+</div>
                <div>12</div>
                <div>-</div>
            </div>

            {/* Photo, Name, Age, Reply, Comment */}
            <div>
                {/* Comment Info */}
                <div className={styles['comment-info']}>
                    <img className={styles['profile-pic']} src={profile_pic}/>
                    <div>Amy Robson</div>
                    <div>1 month ago</div>
                </div>
                <div>
                    <i class="fas fa-reply"></i> Reply
                </div>

                {/* Body */}
                <div className={styles['comment-text']}>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ut aliquet urna. Sed eleifend bibendum felis id elementum. Mauris eleifend odio sit amet arcu maximus malesuada. Sed at velit massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque ornare enim dolor, eget imperdiet erat rhoncus ut. Ut ut iaculis purus. Suspendisse convallis viverra risus vel accumsan.
                </div>
            </div>
        </div>
    );
}

export default Comment;