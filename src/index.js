import {createRoot} from "@wordpress/element"
import App from "./App";

const app = document.getElementById('contact-app');
const root = createRoot(app);

root.render(<App/>);
