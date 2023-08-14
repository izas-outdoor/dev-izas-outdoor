
@echo pnputil -a "%~dp0Realtek\ExtRtk_8940.1\HDX_AsusExt_XPERI4_DSP_RTK_Gen3p1.inf"
pnputil -a "%~dp0Realtek\ExtRtk_8940.1\HDX_AsusExt_XPERI4_DSP_RTK_Gen3p1.inf"

@echo pnputil -a "%~dp0Realtek\Codec_8940.1\HDXASUS.inf" /install
pnputil -a "%~dp0Realtek\Codec_8940.1\HDXASUS.inf" /install

@echo pnputil -a "%~dp0Realtek\Codec_8940.1\HDXSSTASUS.inf" /install
pnputil -a "%~dp0Realtek\Codec_8940.1\HDXSSTASUS.inf" /install

@echo pnputil -a "%~dp0Realtek\RealtekAPO2_771\RealtekAPO2.inf" /install
pnputil -a "%~dp0Realtek\RealtekAPO2_771\RealtekAPO2.inf" /install

@echo pnputil -a "%~dp0Realtek\RealtekASIO_5\RealtekASIO.inf" /install
pnputil -a "%~dp0Realtek\RealtekASIO_5\RealtekASIO.inf" /install

@echo pnputil -a "%~dp0Realtek\RealtekHSA_217\RealtekHSA.inf" /install
pnputil -a "%~dp0Realtek\RealtekHSA_217\RealtekHSA.inf" /install

@echo pnputil -a "%~dp0Realtek\RealtekService_254\RealtekService.inf" /install
pnputil -a "%~dp0Realtek\RealtekService_254\RealtekService.inf" /install

@echo Done
