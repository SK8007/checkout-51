import { act } from "react-dom/test-utils";

const waitForComponentToPaint = async (wrapper) => {
  await act(async () => {
    await new Promise((resolve) => setTimeout(resolve));
    wrapper.update();
  });
};

export { waitForComponentToPaint };
