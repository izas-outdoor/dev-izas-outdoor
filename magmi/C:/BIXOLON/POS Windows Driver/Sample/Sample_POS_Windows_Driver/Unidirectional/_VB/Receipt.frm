VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "BIXOLON"
   ClientHeight    =   1335
   ClientLeft      =   60
   ClientTop       =   345
   ClientWidth     =   2910
   LinkTopic       =   "Form1"
   ScaleHeight     =   1335
   ScaleWidth      =   2910
   StartUpPosition =   3  'Windows Default
   Begin VB.CommandButton ReceiptBt 
      Caption         =   "Prints Receipt"
      Height          =   855
      Left            =   240
      TabIndex        =   0
      Top             =   240
      Width           =   2415
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False

Private Sub ReceiptBt_Click()
For Each prnPrinter In Printers
        If prnPrinter.DeviceName = "BIXOLON SRP-350III" Then
            Set Printer = prnPrinter
            Exit For
        End If
    Next
 

Printer.Font.Size = 8.5
Printer.FontName = "FontControl"
Printer.Print "x"                       'Aligns text to the center

Printer.Font.Size = 17
Printer.FontName = "FontA2x2"
Printer.Print "* BIXOLON CAFE *"

Printer.Font.Size = 8.5
Printer.FontName = "FontA1x1"
Printer.Print "Bundang-gu, Seongam-si"

Printer.Font.Size = 8.5
Printer.FontName = "FontA1x1"
Printer.Print "Sampyeong-dong, 685"

Printer.Font.Size = 8.5
Printer.FontName = "FontA1x1"
Printer.Print "Tel) 858-519-3698 Fax) 3852"

Printer.Font.Size = 8
Printer.FontName = "FontControl"
Printer.Print "w"                       'Aligns text to the left
            
Printer.Font.Size = 8.5
Printer.FontName = "FontA1x1"

Printer.Print "------------------------------------------"
Printer.Print "ORANGE                              $3,500"
Printer.Print "BUFALO WING                         $3,000"
Printer.Print "POTATO                              $1,200"
Printer.Print "------------------------------------------"
Printer.Print "Total                               $7,700"
Printer.Print "Tax 6%                                $470"
Printer.Print "Member Discount                       $900"
Printer.Print "Money received                     $10,000"
Printer.Print "Change                              $2,730"
Printer.Print "------------------------------------------"

Printer.Print "Date : 09/05/2018     Time : 09:32"
Printer.Print "No : 00018857302"
Printer.Print ""
Printer.Print ""
            
Printer.Font.Size = 8.5
Printer.FontName = "FontControl"
Printer.Print "x"                       'Aligns text to the center

Printer.Font.Size = 18
Printer.FontName = "Barcode1"
Printer.Print "123456789012" '+ vbCrLf

'Printer.Font.Size = 9
'Printer.FontName = "FontControl"
'Printer.Print "P"                       'Cut Receipt (partial cut)

Printer.EndDoc
End Sub
