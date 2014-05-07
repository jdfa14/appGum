//
//  ILTMusculoTableViewCell.m
//  iLiftTec
//
//  Created by Ivan Diaz on 3/27/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import "ILTMusculoTableViewCell.h"

@implementation ILTMusculoTableViewCell

- (id)initWithStyle:(UITableViewCellStyle)style reuseIdentifier:(NSString *)reuseIdentifier
{
    self = [super initWithStyle:style reuseIdentifier:reuseIdentifier];
    if (self) {
        // Initialization code
    }
    return self;
}

- (void)awakeFromNib
{
    // Initialization code
}

- (void)setSelected:(BOOL)selected animated:(BOOL)animated
{
    [super setSelected:selected animated:animated];

    // Configure the view for the selected state
}

- (IBAction)checkButton:(id)sender {
    
    self.buttonIsOn = !self.buttonIsOn;
    
    [self updateImage];
    [self.papa updateDia: self.section ejercicio: self.row completado: self.buttonIsOn];
}

-(void) updateImage{
    if(self.buttonIsOn){
        UIImage *btnImage1 = [UIImage imageNamed:@"checkbox-checked.png"];
        [self.checkB setImage:btnImage1 forState:UIControlStateNormal];
    } else{
        UIImage * btnImage2 = [UIImage imageNamed:@"checkbox-unchecked.png"];
        [self.checkB setImage:btnImage2 forState:UIControlStateNormal];
    }
}
@end
