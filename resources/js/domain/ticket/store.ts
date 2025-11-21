import { putRequest } from "../../services/http";
import { storeModuleFactory } from "../../services/store";

export const ticketStore = storeModuleFactory('tickets');